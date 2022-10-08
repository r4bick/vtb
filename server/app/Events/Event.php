<?php

namespace App\Events;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

abstract class Event
{
    use SerializesModels;

    protected Model $model;

    /**
     * Logs information about fired event
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $message = sprintf('Event [%s] was fired with model [%s].', static::class, get_class($model));
        $message .= !empty($changes = $model->getChanges()) ? sprintf(' Changes %s.', json_encode($changes)) : '';
        $message .= !empty($dirty = $model->getDirty()) ? sprintf(' Dirty %s.', json_encode($dirty)) : '';

        $message .= sprintf(' Serialized model %s', $model->toJson());
        Log::info($message);

        $this->model = $model;
    }

    public function getModel(): Model
    {
        return $this->model;
    }
}
