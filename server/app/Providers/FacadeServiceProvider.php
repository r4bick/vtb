<?php

namespace App\Providers;

use App\Curl\Curl;
use App\Curl\CurlInterface;
use App\Http\Clients\MaticClient;
use Illuminate\Support\ServiceProvider;

class FacadeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerCurlInterface();
        $this->registerMaticFacade();
    }

    private function registerCurlInterface(): void
    {
        $this->app->bind(CurlInterface::class, Curl::class);
    }

    private function registerMaticFacade(): void
    {
        $this->app->bind('matic', function ($app) {
            $params = ['url' => config('matic.url'),];

            return $app->makeWith(MaticClient::class, $params);
        });
    }
}
