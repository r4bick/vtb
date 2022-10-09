<?php

namespace Database\Factories;

use App\Constants\OrderTypes;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'id' => Str::uuid(),
            'status' => $this->faker->randomElement(OrderTypes::toArray()),
        ];
    }
}
