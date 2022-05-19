<?php

namespace App\Models;

use Hamcrest\Type\IsInteger;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

if(!isset($_SESSION)){
    session_start();
}

class Product extends Model
{
    protected $table = "product";
    
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

    public static function GetAll($action){
        $appsetting = file_get_contents('../appsettings.json');
        $decoded_json = json_decode($appsetting, false);
        $limit = (integer)$decoded_json->paggination;
        if($action=="")
        $products = DB::table('product')->paginate($limit);
        else if($action == "shop") 
        $products = DB::table('product')->where('status',1)->paginate($limit);
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

    public static function GetProductCategoryAndSubcategory($id){
        if(intval($id)){
            $result = DB::select("SELECT c.category_name as `category_name`, s.sub_category_name From product as p, category as c, sub_category as s 
            WHERE p.sub_category_id = s.id AND s.category_id = c.id AND p.id = $id");
            if($result !=null){
                return $result;
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

    public static function GetBestSale(){
        $product = DB::select('SELECT product_id as id, COUNT(product_id) as total FROM `order_detail` GROUP BY product_id ORDER BY total DESC LIMIT 10');
        $result = array();
        foreach($product as $item){
            $product = Product::GetOne($item->id);
            array_push($result, $product);
        }
        return $result;
    }

    public static function EditProduct($id, $code, $name, $description, $price, $quantity, 
        $image_url, $sub_category_id, $sale, $status){
        //$product = Product::find($id);
        if($code != "" && $name != "" && $description != "" && $price !="" && $quantity!="" && 
                $image_url != "" && $sub_category_id!="" && $sale!="" && $status!=""){
                $time = Carbon::now('Asia/Ho_Chi_Minh');
                $time = $time->toDateTimeString();
                $bool = DB::update("UPDATE `product` SET `code`='$code' ,`name`='$name' ,`quantity`=$quantity ,`price`=$price ,`description`='$description' 
                ,`image_url`='$image_url' ,`sub_category_id`= $sub_category_id ,`sale`=$sale,`status`=$status,`updated_at`='$time' WHERE `id` = $id;");
            if($bool == 1) return redirect()->route('manager-product.index');
        }
        
    }

}
