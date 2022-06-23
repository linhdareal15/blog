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


    public static function AddNewShipping($name, $phone, $address){
        $shipping = new Shipping;
        $shipping->name = $name;
        $shipping->phone = $phone;
        $shipping->address = $address;
        $shipping->save();
        return $shipping->id;
    }

    public static function GetOne($id){
        if(intval($id)){
        $result = DB::table('shipping')->where('id',$id)->get();
        if($result!=null)
            return $result;
        }
        return null;
    }

    public static function EditShipping($id,$name,$phone,$address){
        $bool = DB::update("UPDATE `shipping` SET `name`= '$name' ,`phone`= $phone,`address`= '$address'
         WHERE id = $id ");
        return $bool;
    }
}
