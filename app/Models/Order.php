<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\OrderDetail;
use App\Models\Shipping;
use Carbon\Carbon;

class Order extends Model
{
    use HasFactory;
    protected $table = "order";
    protected $fillable = [
        'customer_name',
        'shipping_id',
        'created_date',
        'updated_date',
        'total_price',
        'note',
        'status'
    ];
    public function __construct($customer_name, $shipping_id, $total_price, $note, $status)
    {
        $this->customer_name = $customer_name;
        $this->shipping_id = $shipping_id;
        $this->total_price = $total_price;
        $this->note = $note;
        $this->status = $status;
    }
    
    public static function GetAll($action){
        $appsetting = file_get_contents('../appsettings.json');
        $decoded_json = json_decode($appsetting, false);
        $limit = (integer)$decoded_json->order_paggination;
        if($action == ""){
            $result = DB::table('order')->paginate($limit);
            if($result!=null) return $result;
        }
        return null;
    }

    public static function GetOne($id){
        $result = DB::table('order')->where('id', $id)->get();
        if($result!=null) return $result;
        return null;
    }

    public static function total_order_money_today()
    {
        $today = Carbon::now()->format('m-d-Y');
        $result = DB::select('SELECT SUM(total_price) as Total from `order` WHERE created_at >=' . $today);
        $total = 0;
        foreach ($result as $t) {
            $total = $t->Total;
        }
        return $total;
    }

    public static function get_7_newest_order()
    {
        $result = DB::select('SELECT * FROM `order` ORDER BY id DESC LIMIT 7');
        if ($result != null) {
            return $result;
        }
        return null;
    }

    public static function GetLast7Date()
    {
        Carbon::now()->timezone('Asia/Ho_Chi_Minh');
        $today = Carbon::now()->format('Y-m-d');
        $temp = 0;
        $result = array();
        for ($i = 6; $i >= 0; $i--) {
            if ($i == 0) {
                $d = strtotime($today);
                $d = date('Y-m-d', $d);
                array_push($result, $d);
                $temp = $d;
            } else {
                $string = '-' . $i . ' days';
                $d = strtotime($today);
                $d = strtotime($string, $d);
                $d = date('Y-m-d', $d);
                array_push($result, $d);
            }
        }
        return $result;
    }

    public static function CountOrderByDay($date)
    {
        $from = $date . ' 00:00:00';
        $to = $date . ' 23:59:59';
        $result = DB::table('order')->whereBetween('created_at', [$from, $to])->count();
        if ($result == 0) $result = 0;
        return $result;
    }
    public static function CountOrderCancelledByDay($date)
    {
        $from = $date . ' 00:00:00';
        $to = $date . ' 23:59:59';
        $result = DB::table('order')->where('status', 5)->whereBetween('created_at', [$from, $to])->count();
        if ($result == 0) $result = 0;
        return $result;
    }

    public static function CountOrderByMonth()
    {
        $result = DB::select("SELECT MONTH(created_at) as 'month' , COUNT(id) as 'total'
        FROM `order` 
        GROUP BY YEAR(created_at), MONTH(created_at)");
        //dd($result);
        $data = array();
        $data_month = array();
        foreach ($result as $item) {
            array_push($data_month, $item->month);
        }
        for ($i = 1; $i <= 12; $i++) {
            if (!in_array($i, $data_month)) {
                array_push($data, 0);
            } else if (in_array($i, $data_month)) {
                foreach ($result as $item) {
                    if($item->month == $i){
                        array_push($data,$item->total);
                    }
                }
            }
        }
        return $data;
    }

    //final function call chart 1
    public static function Statistic_Sale_Last_7Days()
    {
        $Last7Days = Order::GetLast7Date();
        $result = array();
        foreach ($Last7Days as $day) {
            $count = Order::CountOrderByDay($day);
            array_push($result, [$day, $count]);
        }
        return $result;
    }

    //final function call chart 2
    public static function Statistic_Sale_By_Month(){
        $data = Order::CountOrderByMonth();
        return $data;
    }

    public static function ChangeOrderStatus($id,$status){
        $time = Carbon::now('Asia/Ho_Chi_Minh');
        $time = $time->toDateTimeString();
        $bool = DB::update("UPDATE `order` SET `status`= $status ,`updated_at`= '$time' WHERE id = $id ");
        return $bool;
    }

    public static function search($key){
        $result = DB::table('order')->where('id', 'like', '%' . $key . '')->paginate(10);
        if($result != null) return $result;
        return null;
    }
    
}
