<?php

namespace App\Providers;

use App\Constants\TaskTypes;
use App\Constants\WalletTypes;
use App\Models\TaskDeparture;
use App\Models\TaskUser;
use App\Models\User;
use Carbon\Laravel\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

class MorphServiceProvider extends ServiceProvider
{

    public function boot(): void
    {
        Relation::morphMap([
            WalletTypes::USER => User::class,
        ]);

        Relation::morphMap([
            TaskTypes::DEPARTURE => TaskDeparture::class,
            TaskTypes::USER => TaskUser::class,
        ]);
    }
}
