<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Order;

class Status_Order extends Model
{
    use HasFactory;
    protected $fillable = [
        "status"
    ];

    public static function GetAll(){
        $result = DB::table('status_order')->get();
        return $result;
    }
}
