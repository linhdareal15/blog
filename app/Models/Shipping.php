<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Shipping extends Model
{
    use HasFactory;
    protected $table = "shipping";
    protected $fillable = [
        "name",
        "phone",
        "address"
    ];

    public static function GetOne($id){
        $result = DB::table('shipping')->where('id',$id)->get();
        if($result!=null)
            return $result;

        return null;
    }
}
