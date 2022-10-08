<?php

namespace App\Constants;

use ReflectionClass;

trait Serializer
{

    public static function toArray(): array
    {
        return (new ReflectionClass(__CLASS__))->getConstants();
    }
}
