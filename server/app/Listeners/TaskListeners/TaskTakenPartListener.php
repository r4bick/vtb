<?php

namespace App\Listeners\TaskListeners;

use App\Constants\TaskStatuses;
use App\Listeners\Listener;
use App\Models\Task;
use App\Models\TaskDeparture;
use App\Models\TaskUser;
use Illuminate\Database\Eloquent\Model;
use Throwable;

class TaskTakenPartListener extends Listener
{

    /**
     * @param TaskUser|TaskDeparture|Model $model
     *
     * @return void
     * @throws Throwable
     */
    public function execute(TaskUser|TaskDeparture|Model $model): void
    {
        /** @var Task $task */
        $task = Task::whereId($model->task_id)->firstOrFail();
        $task->status = TaskStatuses::IN_PROCESSED;
        $task->participant_number -= 1;
        $task->saveOrFail();
    }
}
