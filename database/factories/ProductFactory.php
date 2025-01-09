<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name'        => $this->faker->name(),
            'slug'        => $this->faker->slug(),
            'qty'         => $this->faker->randomNumber(),
            'price'       => $this->faker->randomFloat(),
            'thumbnail'   => $this->faker->word(),
            'description' => $this->faker->text(),
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now(),
        ];
    }
}
