<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductGallery;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ProductGalleryFactory extends Factory
{
    protected $model = ProductGallery::class;

    public function definition(): array
    {
        return [
            'image'      => $this->faker->image(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'product_id' => Product::factory(),
        ];
    }
}
