<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Status_Order;
class SearchController extends Controller
{
    public function SearchProduct(Request $request){
        $key = $request['param'];
        $products = Product::search($key);
        return view('admin.product')->with('products',$products);
    }

    public function SearchOrder(Request $request){
        $key = $request['param'];
        $orders = Order::search($key);
        $status = Status_Order::GetAll();
        return view('admin.order')->with('orders',$orders)->with('status_order',$status);
    }
}
