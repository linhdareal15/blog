<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id' => Product::factory(),
            'code'=>$this->faker->code(),
            'name' => $this->faker->name(),
            'quantity'=> 10,
            'price' => $this->faker->price(),
            'description' => $this->faker->description(),
            'image_url' => $this->faker->image_url(),
            'sub_category_id' => 1,
            'sale' => 0.1,
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
