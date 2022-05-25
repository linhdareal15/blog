<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class SearchController extends Controller
{
    public function SearchProduct(Request $request){
        // $key = $_GET("key");
        // dd($request['key']);
        $key = $request['param'];
        $products = Product::search($key);
        return view('admin.product')->with('products',$products);
        // return $key;
    }
}
