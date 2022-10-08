<?php

namespace App\Listeners;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class GenerateUuidListener extends Listener
{

    /**
     * @param Model $model
     *
     * @return void
     */
    public function execute(Model $model): void
    {
        $model->setAttribute('id', Str::uuid());
    }
}
