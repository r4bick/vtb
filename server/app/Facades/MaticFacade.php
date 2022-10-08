<?php

namespace App\Facades;

use App\Curl\Response;
use App\Http\Clients\MaticClient;
use Illuminate\Support\Facades\Facade;

/**
 * @method static Response createWallet()
 * @method static Response transferDigitalRubles(string $from_private_key, string $to_public_key, float $amount)
 * @method static Response transferMatic(string $from_private_key, string $to_public_key, float $amount)
 *
 * @see MaticClient
 */
class MaticFacade extends Facade
{
    /**
     * @return string
     */
    public static function getFacadeAccessor(): string
    {
        return 'matic';
    }
}
