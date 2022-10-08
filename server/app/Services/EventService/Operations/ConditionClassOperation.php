<?php

namespace App\Services\EventService\Operations;

use App\Services\EventService\CustomConditionInterface;
use App\Services\EventService\Exceptions\ConditionComparisonException;
use Exception;
use Illuminate\Database\Eloquent\Model;

class ConditionClassOperation extends AbstractOperation
{

    protected string $pattern = '/^class=([a-z_0-9\\\-]+)$/i';

    /**
     * Check if the condition matches type '/class=class_name/'
     * Check this class implement CustomConditionInterface and call method checkModel of this class
     *
     * @param Model $model
     * @param string $condition
     *
     * @return bool
     * @throws ConditionComparisonException
     * @throws Exception
     */
    public function handle(Model $model, string $condition) : bool
    {
        $condition = preg_replace('/\s+/', '', $condition);
        if (!preg_match($this->pattern, $condition, $matches)) {
            throw new ConditionComparisonException();
        }

        $class_name = $matches[1];
        if (!class_exists($class_name) || !isset(class_implements($class_name)[CustomConditionInterface::class])) {
            throw new Exception(
                sprintf('Passed class %s with interface %s does not exist', $class_name, CustomConditionInterface::class)
            );
        }

        return (new $class_name())->checkModel($model);
    }
}
