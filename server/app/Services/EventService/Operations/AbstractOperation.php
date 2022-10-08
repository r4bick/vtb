<?php

namespace App\Services\EventService\Operations;

use App\Services\EventService\Exceptions\ConditionComparisonException;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractOperation
{

    /**
     * Handle custom model event operation
     *
     * @param Model $model
     * @param string $condition
     *
     * @return bool
     * @throws ConditionComparisonException
     */
    abstract public function handle(Model $model, string $condition) : bool;
}
