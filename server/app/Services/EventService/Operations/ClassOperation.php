<?php

namespace App\Services\EventService\Operations;

use App\Services\EventService\Exceptions\ConditionComparisonException;
use Exception;
use Illuminate\Database\Eloquent\Model;

class ClassOperation extends AbstractOperation
{

    protected string $pattern = '/^class=\[([a-z_0-9\\\-]+),([a-z_0-9\-]+)\]$/i';

    /**
     * Check if the condition matches type '/class=[class_name,method_name]/' and call this method
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

        [$class_name, $method] = [$matches[1], $matches[2]];
        if ($class_name === 'this') {
            return $model->$method();
        }

        if (!class_exists($class_name)) {
            throw new Exception(sprintf('Class \'%s\' does not exist', $class_name));
        }

        if (!method_exists($class_name, $method)) {
            throw new Exception(sprintf('Method \'%s\' does not exist in class \'%s\'', $method, $class_name));
        }

        return (new $class_name)->$method($model);
    }
}
