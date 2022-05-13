<?php
namespace App\Http\Controllers;
session_start();
use Illuminate\Support\Facades\DB;
class ShopController extends Controller
{
    
    public function GetCategory(){
        $category = DB::table("category")->get();
        return $category;
    }
    
    public static function GetProduct(){
        $limit = 10;
        $total =0 ;
        $total_record = DB::select("Select count(id) as total from product");
        foreach ($total_record as $t){
            $total_record = $t->total;
            $total = $total_record;
        }
        
        $current_page = isset($_GET['page']) ? $_GET['page']  :1;
        
        $total_page = ceil($total_record/$limit);

        if($current_page > $total_page){
            $current_page = $total_page;
        }else if($current_page < 1){
            $current_page = 1;
        }

        $start = ($current_page - 1) * $limit;
        $result = DB::select("SELECT * FROM product LIMIT $start,$limit");
        return $result;
    }

    public function AddToCart($id){
        //select * from product
        //if(isset($_GET['action']) && $_GET['action']=="add"){ 
            //$id=intval($_GET['id']); 
            if(isset($_SESSION['cart'][$id]) && $_SESSION['cart'][$id]['id']==$id){ 
                  
                $_SESSION['cart'][$id]['quantity']+=1; 
                //header("Location: shop.php");
                return redirect()->route('product.index');
            }else{ 
                $query_s=DB::select("SELECT * FROM product where id = $id"); 
                if($query_s!=0){ 
                    $row_s=$query_s; 
                   foreach ($row_s as $row){
                       $_SESSION['cart'][$row->id]=array( 
                            "id" => $row->id,
                            "image_url" => $row->image_url,
                            "name" => $row->name,
                            "quantity" => 1, 
                            "price" => $row->price, 
                        );
                   }
                   return redirect()->route('product.index');
                }else{ 
                    $message="This product id it's invalid!";    
                    print_r($message);
                }   
            //} 
        } 
    }

    public static function index(){
        return view("shop");
    }

}