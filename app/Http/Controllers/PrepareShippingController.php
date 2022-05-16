<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;

if(!isset($_SESSION)){
    session_start();
}

class PrepareShippingController extends Controller{
    public function __construct()
    {
       $this->middleware('auth');   //dùng để bắt đăng nhập
    }

    public function index(){ 
        
            $product=$_SESSION['cart'];
            $tong = $_SESSION['tong'];
            if($_POST['name'] !=null && $_POST['phone']!=null && $_POST['email']!=null  && $_POST['address']!=null){
                $name= $_POST['name'];
                $phone=$_POST['phone'];
                $email=$_POST['email'];
                $address=$_POST['address'];
                if($_POST['note'] !=null){
                    $note = $_POST['note'];
                    return view('prepare')->with('product',$product)->with('tong',$tong)->with('name',$name)->with('phone',$phone)->with("email",$email)
                    ->with("address",$address)->with("note",$note);

                } 
               
                return view('prepare')->with('product',$product)->with('tong',$tong)->with('name',$name)->with('phone',$phone)->with("email",$email)->with("address",$address);
            }
            ;
    }    
}