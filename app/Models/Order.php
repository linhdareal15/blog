<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
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
    public function __construct($customer_name, $shipping_id, $total_price, $note, $status){
        $this->customer_name = $customer_name;
        $this->shipping_id = $shipping_id;
        $this->total_price = $total_price;
        $this->note = $note;
        $this->status = $status;
    }


    public static function total_order_money_today(){
        $today = Carbon::now()->format('m-d-Y');
        $result = DB::select('SELECT SUM(total_price) as Total from `order` WHERE created_at >='.$today);
        $total = 0;
        foreach ($result as $t){
            $total = $t->Total;
        }
        return $total;
    }

    
}
