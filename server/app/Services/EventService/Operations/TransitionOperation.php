<?php

namespace App\Services\EventService\Operations;

use App\Services\EventService\Exceptions\ConditionComparisonException;
use Exception;
use Illuminate\Database\Eloquent\Model;

class TransitionOperation extends AbstractOperation
{

    protected string $pattern = '/^([a-z_0-9\-]+)\s*=\s*{(.+),(.+)}$/iu';

    /**
     * Check if the condition matches type 'attribute_name={org_value,cur_val}'
     * The original state of the model correspond to org_value, the current state correspond to cur_value
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

        [$attribute, $origin_value, $new_value] = [$matches[1], $matches[2], $matches[3]];
        if (!array_key_exists($attribute, $model->getAttributes())) {
            throw new Exception(sprintf('Attribute \'%s\' does not exist in model \'%s\'', $attribute, get_class($model)));
        }

        if ($model->getOriginal($attribute) === $model->$attribute) {
            return false;
        }

        $origin_value = $origin_value !== 'null' ? $origin_value : null;
        $new_value = $new_value !== 'null' ? $new_value : null;

        return ($model->getOriginal($attribute) == $origin_value || trim($origin_value) === '*') &&
            ($model->$attribute == $new_value || trim($new_value) === '*');
    }
}
