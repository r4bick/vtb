<?php

namespace App\Services\EventService\CustomModelEvents;

use App\Services\EventService\Operations\AttributeChangeOperation;
use App\Services\EventService\Operations\ClassOperation;
use App\Services\EventService\Operations\ConditionClassOperation;
use App\Services\EventService\Operations\StateOperation;
use App\Services\EventService\Operations\TransitionOperation;

class UpdatingCustomModelEvent extends AbstractCustomModelEvent
{

    protected static array $operations = [
        ConditionClassOperation::class,
        ClassOperation::class,
        AttributeChangeOperation::class,
        TransitionOperation::class,
        StateOperation::class,
    ];
}
