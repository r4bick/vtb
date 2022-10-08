<?php

namespace App\Console\Commands;

use App\Facades\MaticFacade;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class DebugCommand extends Command
{

    protected $signature = 'debug';

    public function handle(): void
    {
        $response = MaticFacade::transferDigitalRubles(config('matic.private_key'), '0x821A2140AAB6b9A28Cb1C0A3830FA7b71b8A4178', 100);
        Log::debug('', $response->getResponse());
    }
}
