<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Http\Requests\ProductRequest;
use function PHPUnit\Framework\returnSelf;

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
            $result = DB::select("select * from `product` where `id` = $id AND `status`=1");
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

    public static function search($key){
        $result = DB::table('product')->where('name', 'like', '%' . $key . '%')->paginate(10);
        if($result != null) return $result;
        return null;
    }

    public static function storeImage(ProductRequest $request) {
        $fileName = $request->get('code') . '.' . $request->file('photo')->extension();      
        $path = $request->file('photo')->storeAs('public/product',$fileName);
        return $path;
    }

    public static function GetLastID(){
        $result = DB::select('SELECT MAX(id) as max FROM `product`');
        foreach($result as $item)
            return $item->max;
    }

    public static function create_new(ProductRequest $request){
        $data = $request->all();
        $id = Product::GetLastID();
        $id = $id+1;
        $code = $data['code'];
        $product_name = $data['name'];
        $description = $data['description'];
        $quantity = $data['quantity'];
        $price = $data['price'];
        $sub_category_id = $data['sub_category_id'];
        $sale = $data['sale'];
        $status = $data['status'];
        $image_url = Product::storeImage($request);
        $p = new Product($id,$code, $product_name, $quantity, $price, $description, $image_url, $status, $sub_category_id, $sale);
        $p->save();
        // Product::create([
        //     'id'=> 10000,
        //     'code' => $code,
        //     'name' => $product_name,
        //     'quantity' => $quantity,
        //     'price' => $price,
        //     'description' => $description,
        //     'image_url' => $image_url,
        //     'status' => $status,
        //     'sub_category_id' => $sub_category,
        //     'sale' => $sale
        // ]);
    }

}
