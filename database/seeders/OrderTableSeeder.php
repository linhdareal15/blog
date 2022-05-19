<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Shipping;
use App\Models\Product;
class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i<=300;$i++){
            $s = new Shipping();
            $s->name = "Neu Ma Khong Phai Bun ".$i;
            $s->phone = "0345291510";
            $s->address = "Noi nao do";
            $s->save();

            $shipping_id = $s->id;

            $product = Product::GetOne(rand(1,100));

            $o = new Order(
                "Neu Ma Khong Phai Bun ".$i."",
                $shipping_id,
                $product->price,
                "Cu giao can than la duoc",
                1
            );

            $start_date = '2022-05-13';
            $end_date = '2022-05-20';
            $min = strtotime($start_date);
            $max = strtotime($end_date);
            $date_random = rand($min, $max);
            $date_random = date('Y-m-d H:i:s',$date_random);

            $o->customer_name = $o->customer_name;
            $o->shipping_id = $shipping_id;
            $o->total_price= $o->total_price;
            $o->note = $o->note;
            $o->status = $o->status;
            $o->created_at = $date_random;
            $o->updated_at = $date_random;
            $o->save();

            $order_id = $o->id;
            $od = new OrderDetail($order_id,$product,1);
            $od->order_id = $order_id;
            $od->product_id = $od->product_id;
            $od->price = $od->price;
            $od->quantity = $od->quantity;
            $od->created_at = $date_random;
            $od->updated_at = $date_random;
            $od->save();
        }
    }
}
