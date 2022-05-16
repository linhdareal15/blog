<?php

namespace Database\Seeders;
require_once 'vendor/autoload.php';

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Product::factory()->times(count:100)->create();
        for($i=1;$i<=100;$i++){
            $p=new Product(
                $i,"HW-test".$i."",
                "Damier T-Shirt".$i."",
                10, rand(100000,300000),
                "neumakhongphaianh",
                "Men/Shirt/1_0.webp",
                1,1,0.5 
            );
            $p->id = $p->id;
            $p->code = $p->code;
            $p->status = $p->status;
            $p->name = $p->name;
            $p->description = $p->description;
            $p->price = $p->price;
            $p->image_url = $p->image_url;
            $p->sale = $p->sale;
            $p->quantity = $p->quantity;
            $p->save();
        }
    }
}
