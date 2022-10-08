<?php

namespace App\Http\Controllers;

use App\Facades\MaticFacade;
use App\Models\Wallet;
use Illuminate\Http\Request;

class WalletController extends BaseController
{

    protected static string $model = Wallet::class;

    /**
     * @param Request $request
     * @param int|string $public_key
     *
     * @return array
     */
    public function transferSystemDigitalRubles(Request $request, int|string $public_key): array
    {
        return $this->transfer( config('matic.private_key'), $public_key, $request->get('attributes')['amount']);
    }

    /**
     * @param Request $request
     * @param int|string $public_key
     *
     * @return array
     */
    public function transferDigitalRubles(Request $request, int|string $public_key): array
    {
        $id = auth()->user()->getAuthIdentifier();
        /** @var Wallet $wallet */
        $wallet = Wallet::whereId($id)->firstOrFail();

        return $this->transfer($wallet->private_key, $public_key, $request->get('attributes')['amount']);
    }

    /**
     * @param string $from_private_key
     * @param string $to_public_key
     * @param float $amount
     *
     * @return array
     */
    protected function transfer(string $from_private_key, string $to_public_key, float $amount): array
    {
        $response = MaticFacade::transferDigitalRubles($from_private_key, $to_public_key, $amount);

        return $response->getResponse();
    }
}
