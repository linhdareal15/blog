<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Shipping;
use App\Models\Status_Order;
use App\Models\OrderLogs;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::GetAll("");
        $status = Status_Order::GetAll();
        return view("admin.order")->with('orders',$orders)
        ->with('status_order',$status);
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
        if(intval($id)){
            $order = Order::GetOne($id);
            $order_log = OrderLogs::GetOrderLog($id);
            $order_detail = null;
            $shipping = null;
            $order_id = 0;
            $customer_name = "";
            $order_at = "";
            $order_total_price = 0;
            foreach($order as $o){
                $order_detail = OrderDetail::GetOne($o->id);
                $shipping = Shipping::GetOne($o->shipping_id);
                $order_id = $o->id;
                $customer_name = $o->customer_name;
                $order_at = $o->created_at;
                $order_total_price = $o->total_price;
            }
            if($order_detail !=null && $shipping !=null){
                return view('admin.editorder')->with('order_detail',$order_detail)
                ->with('shipping',$shipping)
                ->with('orders',$order)
                ->with('order_id',$order_id)
                ->with('customer_name',$customer_name)
                ->with('order_at',$order_at)
                ->with('order_total_price',$order_total_price)
                ->with('order_log', $order_log);
            }
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,$status)
    {
        if(intval($id) && $status!=""){
           $bool =  Order::ChangeOrderStatus($id,$status);
           $status_name = Status_Order::GetName($status);
           if($bool == 1){
               $log = "Status changed to ".$status_name;
               OrderLogs::CreateLog($id , $log);
            return redirect()->back();
           } 
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
}
