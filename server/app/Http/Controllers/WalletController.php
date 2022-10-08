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
    public static function transferDigitalRubles(Request $request, int|string $public_key): array
    {
        $response = MaticFacade::transferDigitalRubles(
            config('matic.private_key'),
            $public_key,
            $request->get('attributes')['amount']
        );

        return $response->getResponse();
    }
}
