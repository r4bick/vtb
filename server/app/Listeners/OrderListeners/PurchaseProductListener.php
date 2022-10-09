<?php

namespace App\Listeners\OrderListeners;

use App\Facades\MaticFacade;
use App\Listeners\Listener;
use App\Models\Order;
use App\Models\Wallet;
use Illuminate\Database\Eloquent\Model;

class PurchaseProductListener extends Listener
{

    public function execute(Order|Model $model): void
    {
        /** @var Wallet $wallet */
        $wallet = Wallet::whereId(auth()->user()->getAuthIdentifier())->firstOrFail();

        MaticFacade::transferDigitalRubles($wallet->private_key, config('matic.public_key'), $model->price);
    }
}
