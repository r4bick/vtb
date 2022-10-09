<?php

namespace App\Listeners\OrderListeners;

use App\Listeners\Listener;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class SetPriceProductListener extends Listener
{

    /**
     * @param Order|Model $model
     *
     * @return void
     */
    public function execute(Order|Model $model): void
    {
        /** @var Product $product */
        $product = Product::whereId($model->product_id)->firstOrFail();

        $model->setAttribute('price', $product->price);
    }
}
