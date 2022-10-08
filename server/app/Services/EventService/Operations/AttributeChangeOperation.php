<?php

namespace App\Services\EventService\Operations;

use App\Services\EventService\Exceptions\ConditionComparisonException;
use Exception;
use Illuminate\Database\Eloquent\Model;

class AttributeChangeOperation extends AbstractOperation
{

    protected string $pattern = '/^([a-z_0-9\-]+)$/i';

    /**
     * Check if the condition matches type '/attribute_name/' and this attribute was change
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

        $attribute = $matches[1];
        if (!array_key_exists($attribute, $model->getAttributes())) {
            throw new Exception(sprintf('Attribute \'%s\' does not exist in model \'%s\'', $attribute, get_class($model)));
        }

        return $model->getOriginal($attribute) !== $model->$attribute;
    }
}
