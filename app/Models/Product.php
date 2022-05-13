<?php

namespace App\Models;

use Hamcrest\Type\IsInteger;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        "id",
        "code",
        "name",
        "quantity",
        "price",
        "description",
        "image_url",
        "create_date",
        "status",
        "sub_category_id",
        "sale"
    ];
    public function GetAll(){
        $products = DB::table('product')->paginate(20);
        return $products;
    }
    public function GetOne($id){
        if(intval($id)){
            $product = DB::select("select * from `product` where `id` = $id");
            return $product;
        }
        return null;
    }
    public function GetBySubCategoryId($id){
        if(intval($id)){
            $products = DB::select("select * from `product` where sub_category_id = $id");
            return $products;
        }
        return null;
    }
    public function GetFiveNewest(){
        $products = DB::select("select * from `product` ORDER BY id DESC LIMIT 5");
        if($products!=null){
            return $products;
        }
        return null;
    }
}
