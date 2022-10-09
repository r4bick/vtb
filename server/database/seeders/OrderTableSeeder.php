<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class OrderTableSeeder extends Seeder
{

    public function run(): void
    {
        $users = User::all()->toArray();
        shuffle($users);
        for ($i = 0; $i < random_int(1, count($users)); $i++) {
            Order::factory()
                ->state(new Sequence(
                    function (Sequence $sequence) {
                        /** @var Product $product */
                        $product = Product::all()->random();

                        return [
                            'product_id' => $product->id,
                            'price' => $product->price,
                        ];
                    },
                ))
                ->createQuietly([
                    'user_id' => $users[$i]['id'],
                ]);
        }
    }
}
