<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
class OrderDetail extends Model
{
    use HasFactory;
    protected $table = "order_detail";
    protected $fillable = [
        "order_id",
        "product_id",
        "product_name",
        "price",
        "quantity",
        "created_at",
        "updated_at"
    ];

    public function __construct($order_id, Product $product,$quantity){
        $this->order_id = $order_id;
        $this->product_id = $product->id;
        $this->product_name = $product->name;
        $this->price = $product->price;
        $this->quantity = $quantity;
    }

    public static function GetOne($id){
       $result =  DB::table('order_detail')->where('order_id',$id)->get();
       if($result !=null){
           return $result;
       }
       return null;
    }
}
