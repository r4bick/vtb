<?php

namespace App\Services\EventService\Operations;

use App\Services\EventService\Exceptions\ConditionComparisonException;
use Exception;
use Illuminate\Database\Eloquent\Model;

class StateOperation extends AbstractOperation
{

    protected string $pattern = '/^([a-z_0-9\-]+)\s*=\s*{(.+)}$/iu';

    /**
     * Check if the condition matches type 'attribute_name={value}'
     * The current state of the model corresponds to this value
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
        if (!preg_match($this->pattern, $condition, $matches)) {
            throw new ConditionComparisonException();
        }

        [$attribute, $value] = [$matches[1], $matches[2]];
        if (!array_key_exists($attribute, $model->getAttributes())) {
            throw new Exception(sprintf('Attribute \'%s\' does not exist in model \'%s\'', $attribute, get_class($model)));
        }

        return $model->$attribute === $value;
    }
}
