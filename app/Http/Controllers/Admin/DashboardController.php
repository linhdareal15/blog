<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;

use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $best_sale_product = Product::GetBestSale();
        $seven_newest_order = Order::get_7_newest_order();
        $total_user = User::TotalUsersCount();
        $today_user_count = User::today_users_count();
        $total_order_money_today = Order::total_order_money_today();

        //chart 1
        $chart1_data = Order::Statistic_Sale_Last_7Days();
        $chart1_date = [];
        $chart1_value = [];

        //chart 2
        $chart2_data = Order::Statistic_Sale_By_Month();
        foreach ($chart1_data as $item){
            array_push($chart1_date,$item[0]);
            array_push($chart1_value,$item[1]);
        }

        return view('admin.index')->with('today_user_count', $today_user_count)
            ->with('total_user',$total_user)->with('total_order_money_today',$total_order_money_today)
            ->with('seven_newest_order',$seven_newest_order)
            ->with('chart1_date',$chart1_date)
            ->with('chart1_value',$chart1_value)
            ->with('chart2_data',$chart2_data)
            ->with('best_sale_product',$best_sale_product);
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
