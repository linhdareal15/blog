<?php

namespace App\Models;

use Hamcrest\Type\IsInteger;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

if(!isset($_SESSION)){
    session_start();
}

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        "code",
        "name",
        "quantity",
        "price",
        "description",
        "image_url",
        "status",
        "sub_category_id",
        "sale"
    ];

    public function __construct($id,$code, $name, $quantity, $price, $description, $image_url, $status, $sub_category_id, $sale){
        $this->id = $id;
        $this->code = $code;
        $this->name = $name;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->description = $description;
        $this->image_url = $image_url;
        $this->status = $status;
        $this->sub_category_id = $sub_category_id;
        $this->sale = $sale;
    }

    public static function GetAll(){
        $products = DB::table('product')->paginate(20);
        return $products;
    }
    public static function GetOne($id){
        if(intval($id)){
            $result = DB::select("select * from `product` where `id` = $id");
            $result = (array)$result;
            foreach($result as $item){
                $p = new Product($item->id,$item->code, $item->name, $item->quantity, $item->price, $item->description, 
                $item->image_url, $item->status, $item->sub_category_id,$item->sale); 
                return $p;
            }
        }
        return null;
    }
    public static function GetBySubCategoryId($id){
        if(intval($id)){
            $products = DB::select("select * from `product` where sub_category_id = $id");
            return $products;
        }
        return null;
    }
    public static function GetFiveNewest(){
        $products = DB::select("select * from `product` ORDER BY id DESC LIMIT 5");
        if($products!=null){
            return $products;
        }
        return null;
    }

    public static function GetProductFromCart(){
        if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
            $products = $_SESSION['cart'];
            $total = $_SESSION['tong'];
            // return ['products'-> $products ];
        }
    }
}
