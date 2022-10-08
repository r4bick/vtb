<?php

namespace App\Listeners;

use App\Constants\WalletTypes;
use App\Facades\MaticFacade;
use App\Models\Departure;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Throwable;

class CreateWalletListener extends Listener
{

    /**
     * @param User|Departure|Model $model
     *
     * @return void
     * @throws Throwable
     */
    public function execute(User|Departure|Model $model): void
    {
        $keys = MaticFacade::createWallet()->getResponse();
        $keys = $this->keyToSnakeKeys($keys);

        $type = $model instanceof User ? WalletTypes::USER : WalletTypes::DEPARTURE;

        $wallet = new Wallet();
        $wallet->forceFill([...$keys, ...['id' => $model->getKey(), 'type' => $type]]);
        $wallet->saveOrFail();
    }

    /**
     * @param array $keys
     *
     * @return array
     */
    protected function keyToSnakeKeys(array $keys): array
    {
        $arr = [];
        $callback = function (string $value, string $key) use (&$arr) {
            $arr[Str::snake($key)] = $value;
        };
        array_walk($keys, $callback);

        return $arr;
    }
}
