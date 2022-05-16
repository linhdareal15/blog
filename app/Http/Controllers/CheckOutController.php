<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

if(!isset($_SESSION)){
    session_start();
}

class CheckOutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (isset($_SESSION['cart'])) {
            $products = $_SESSION['cart'];
            $tong = $_GET['tong'];
            $_SESSION['tong'] = $tong;
            $product = $_SESSION['cart'];

            foreach ($products as $item) {
                $amount = $_GET['amount' . $item['id']];
                if ($amount > 0) {
                    $product[$item['id']]['quantity'] = $amount;
                    $_SESSION['cart'][$item['id']]['quantity'] = $amount;
                }
            }
            return view('checkout')->with('products', $products)->with('tong', $tong);
        }
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
}
