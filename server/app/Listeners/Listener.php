<?php

namespace App\Listeners;

use App\Events\Event;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

abstract class Listener
{
    protected Event $event;

    /**
     * Event handler method
     *
     * @param Event $event
     */
    public function handle(Event $event): void
    {
        Log::debug('here');
        $this->event = $event;
        if (!static::isProceed($event->getModel())) {
            return;
        }

        $message = sprintf('Listener [%s] event [%s].', static::class, get_class($event));
        Log::info($message);

        $this->execute($event->getModel());
    }

    /**
     * @param Model $model
     *
     * @return void
     */
    public abstract function execute(Model $model): void;

    /**
     * Allows to define the conditions for the listener
     *
     * @param Model $model
     *
     * @return bool
     */
    protected static function isProceed(Model $model) : bool
    {
        return true;
    }
}
