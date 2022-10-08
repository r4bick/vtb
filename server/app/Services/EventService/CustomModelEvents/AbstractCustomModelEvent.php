<?php

namespace App\Services\EventService\CustomModelEvents;

use App\Services\EventService\Exceptions\ConditionComparisonException;
use App\Services\EventService\Operations\AbstractOperation;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

abstract class AbstractCustomModelEvent
{

    protected static array $operations = [];

    /**
     * @param Model $model
     * @param string $condition
     *
     * @return bool
     * @throws ConditionComparisonException
     */
    public function handle(Model $model, string $condition) : bool
    {
        /** @var AbstractOperation $operation */
        foreach (static::$operations as $operation) {
            try {
                return (new $operation)->handle($model, $condition);
            } catch (ConditionComparisonException $exception) {
            } catch (Exception $exception) {
                Log::error($exception->getMessage());
            }
        }

        throw new ConditionComparisonException(
            sprintf('[%s]. Invalid condition string \'%s\' for custom event handler %s.', get_class($model), $condition, static::class)
        );
    }
}
