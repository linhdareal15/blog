<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Shipping;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\OrderLogs;


if(!isset($_SESSION)){
    session_start();
}

class ShippingController extends Controller{
    public function __construct()
    {
       $this->middleware('auth');   //dùng để bắt đăng nhập
    }
    public function create_order(){
        $products = $_SESSION['cart'];
        $name = $_POST['name'];
        $phone = $_POST['phone']; 
        $address = $_POST['address'];
        $shipping_id = Shipping::AddNewShipping($name,$phone,$address);
        $total_price = $_SESSION['tong'];
        $note = $_POST['note'] !=null ? $_POST['note'] : "";
        $order = new Order($name,$shipping_id,$total_price,$note,1);
        $order->save();

        $order_id = $order->id;
        foreach ($products as $item){
            $product = Product::GetOne($item['id']);
            if($product !=null){
                $order_detail = new OrderDetail($order_id,$product,$item['quantity']);
                $order_detail->save();
            }
        }
        $log = "Order #".$order_id." has been created";
        OrderLogs::CreateLog($order_id,$log);

        unset($_SESSION['cart']);

        return redirect()->route('home');
    }



}