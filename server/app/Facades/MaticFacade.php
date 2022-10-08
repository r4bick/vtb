<?php

namespace App\Facades;

use App\Curl\Response;
use App\Http\Clients\MaticClient;
use Illuminate\Support\Facades\Facade;

/**
 * @method static Response createWallet()
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
