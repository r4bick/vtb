<?php

namespace App\Console\Commands;

use App\Facades\MaticFacade;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class DebugCommand extends Command
{

    protected $signature = 'debug';

    public function handle(): void
    {
        $wallet = MaticFacade::createWallet();
    }
}
