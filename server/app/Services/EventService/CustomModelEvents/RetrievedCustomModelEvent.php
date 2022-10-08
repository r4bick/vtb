<?php

namespace App\Services\EventService\CustomModelEvents;

use App\Services\EventService\Operations\ClassOperation;
use App\Services\EventService\Operations\ConditionClassOperation;
use App\Services\EventService\Operations\StateOperation;

class RetrievedCustomModelEvent extends AbstractCustomModelEvent
{

    protected static array $operations = [
        ConditionClassOperation::class,
        ClassOperation::class,
        StateOperation::class,
    ];
}
