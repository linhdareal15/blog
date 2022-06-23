<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Http\Requests\ProductRequest;
use App\Models\Product;

class AddNewController extends Controller
{
    public function index_product(){
        $sub_category = SubCategory::GetAll();
        return view('admin.addproduct')->with('sub_category', $sub_category);
    }

    public function AddProduct(ProductRequest $request){
        Product::create_new($request);
        return redirect()->route('manager-product.index');
    }

}
