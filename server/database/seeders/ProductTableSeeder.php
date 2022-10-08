<?php

namespace Database\Seeders;

use App\Models\Product;
use Database\Factories\ProductFactory;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{

    public function run(): void
    {
        foreach (ProductFactory::$stubProducts as $attributes) {
            Product::factory()->create($attributes);
        }
    }
}
