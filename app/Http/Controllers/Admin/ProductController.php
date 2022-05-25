<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\SubCategory;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function __construct(){
    //     $this->middleware('auth:admin');
    // }
    public function index()
    {
        $products = Product::GetAll("");
        return view('admin.product')->with('products',$products);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->all();
        $photo = $request->file('photo'); 
        $bool = Product::EditProduct($data['id'], $data['code'],$data['name'],$data['description'],
                    $data['price'],$data['quantity'], $data['image_url'],$data['sub_category_id'],
                    $data['sale'],$data['status']);
        if($bool == true){
            return redirect()->route('manager-product.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(intval($id)){
            $sub_category = SubCategory::GetAll();
            $product = Product::GetOne($id);
            return view('admin.editproduct')
            ->with('product', $product)
            ->with('sub_category', $sub_category);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    protected function storeImage(Request $request) {
        $path = $request->file('photo')->store('public/profile');
        return substr($path, strlen('public/'));
    }
}
