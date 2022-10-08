<?php

namespace App\Services\EventService;

use Illuminate\Database\Eloquent\Model;

interface CustomConditionInterface
{

    /**
     * Allows to define an arbitrary condition for custom model event
     *
     * @param Model $model
     *
     * @return bool
     */
    public function checkModel(Model $model) : bool;
}
