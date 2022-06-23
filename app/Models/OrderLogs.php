<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class OrderLogs extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'log',
        'created_at',
        'updated_at'
    ];
    public static function CreateLog($order_id,$log){
        if($log!=""&& (intval($order_id)) && $order_id>0){
            $odlog = new OrderLogs;
            $odlog->order_id = $order_id;
            $odlog->log = $log;
            $odlog ->save();
        }
    }

    public static function GetOrderLog($id){
        $result = DB::table('order_logs')->where('order_id', $id)->get();
        if($result!=null) return $result;
        return null;
    }

}
