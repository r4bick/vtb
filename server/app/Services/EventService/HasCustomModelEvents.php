<?php

namespace App\Services\EventService;

use App\Services\EventService\CustomModelEvents\AbstractCustomModelEvent;
use App\Services\EventService\CustomModelEvents\CreatedCustomModelEvent;
use App\Services\EventService\CustomModelEvents\CreatingCustomModelEvent;
use App\Services\EventService\CustomModelEvents\DeletedCustomModelEvent;
use App\Services\EventService\CustomModelEvents\DeletingCustomModelEvent;
use App\Services\EventService\CustomModelEvents\RetrievedCustomModelEvent;
use App\Services\EventService\CustomModelEvents\UpdatedCustomModelEvent;
use App\Services\EventService\CustomModelEvents\UpdatingCustomModelEvent;
use App\Services\EventService\Exceptions\ConditionComparisonException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

trait HasCustomModelEvents
{

    private ?array $dispatchesCustomEvents = null;

    public static function bootHasCustomModelEvents() : void
    {
        static::updating(function(self  $model) {
            $custom_events = $model->getCustomModelEvents();
            $model->fireCustomModelEvents(new UpdatingCustomModelEvent(), $custom_events['updating'] ?? []);
        });
        static::updated(function(self $model) {
            $custom_events = $model->getCustomModelEvents();
            $model->fireCustomModelEvents(new UpdatedCustomModelEvent(), $custom_events['updated'] ?? []);
        });
        static::creating(function(self $model) {
            $custom_events = $model->getCustomModelEvents();
            $model->fireCustomModelEvents(new CreatingCustomModelEvent(), $custom_events['creating'] ?? []);
        });
        static::created(function(self $model) {
            $custom_events = $model->getCustomModelEvents();
            $model->fireCustomModelEvents(new CreatedCustomModelEvent(), $custom_events['created'] ?? []);
        });
        static::deleting(function(self $model) {
            $custom_events = $model->getCustomModelEvents();
            $model->fireCustomModelEvents(new DeletingCustomModelEvent(), $custom_events['deleting'] ?? []);
        });
        static::deleted(function(self $model) {
            $custom_events = $model->getCustomModelEvents();
            $model->fireCustomModelEvents(new DeletedCustomModelEvent(), $custom_events['deleted'] ?? []);
        });
        static::retrieved(function(self $model) {
            $custom_events = $model->getCustomModelEvents();
            $model->fireCustomModelEvents(new RetrievedCustomModelEvent(), $custom_events['retrieved'] ?? []);
        });
    }

    /**
     * Fire custom model events
     *
     * @param AbstractCustomModelEvent $event
     * @param array $custom_events
     */
    private function fireCustomModelEvents(AbstractCustomModelEvent $event, array $custom_events) : void
    {
        foreach ($custom_events as $change => $condition) {
            if ($this->needFireCustomEvent($event, $condition)) {
                $this->fireModelEvent($change, false);
            }
        }
    }

    /**
     * Check is event condition true
     *
     * @param AbstractCustomModelEvent $event
     * @param string $condition
     *
     * @return bool
     */
    private function needFireCustomEvent(AbstractCustomModelEvent $event, string $condition) : bool
    {
        try {
            return $event->handle($this, $condition);
        } catch (ConditionComparisonException $exception) {
            Log::error($exception->getMessage());
        }

        return false;
    }

    /**
     * Return array of dispatchesCustomEvents or init if not exist
     *
     * @return array
     */
    private function getCustomModelEvents() : array
    {
        if (is_null($this->dispatchesCustomEvents)) {
            $this->initCustomModelEvents();
        }

        return $this->dispatchesCustomEvents;
    }

    /**
     * Init an array [Base Model Event Name => [Dispatcher Array Key => Condition, ...], ...]
     */
    private function initCustomModelEvents() : void
    {
        $this->dispatchesCustomEvents = [];
        foreach ($this->dispatchesEvents as $change => $event) {
            if (!Str::contains($change, ':')) {
                continue;
            }

            [$model_event, $condition] = explode(':', $change, 2);
            $this->dispatchesCustomEvents[$model_event][$change] = trim($condition);
        }
    }
}
