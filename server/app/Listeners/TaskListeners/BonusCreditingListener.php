<?php

namespace App\Listeners\TaskListeners;

use App\Constants\TaskTypes;
use App\Facades\MaticFacade;
use App\Listeners\Listener;
use App\Models\Task;
use App\Models\TaskDeparture;
use App\Models\TaskUser;
use App\Models\Wallet;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class BonusCreditingListener extends Listener
{

    /**
     * @throws Exception
     */
    public function execute(Task|Model $model): void
    {
        switch ($model->type) {
            case TaskTypes::USER:
                $this->executeUserTask($model);
                break;
            case TaskTypes::DEPARTURE:
                $this->executeDepartureTask($model);
                break;
            default:
                throw new Exception();
        }
    }

    /**
     * @param Task $model
     *
     * @return void
     */
    protected function executeUserTask(Task $model): void
    {
        /** @var TaskUser $task_user */
        $task_user = TaskUser::whereTaskId($model->id)->firstOrFail();
        /** @var Wallet $wallet */
        $wallet = Wallet::whereId($task_user->user_id)->firstOrFail();

        $this->transfer(config('matic.private_key'), $wallet->public_key, $model->reward);
    }

    /**
     * @param Task $model
     *
     * @return void
     */
    protected function executeDepartureTask(Task $model): void
    {
        /** @var TaskDeparture $task_departure */
        $task_departure = TaskDeparture::whereTaskId($model->id)->firstOrFail();
        /** @var Wallet $wallet */
        $wallet = Wallet::whereId($task_departure->departure_id)->firstOrFail();

        $this->transfer(config('matic.private_key'), $wallet->public_key, $model->reward);
    }

    protected function transfer(string $from_private_key, string $to_public_key, float $amount): array
    {
        $response = MaticFacade::transferDigitalRubles($from_private_key, $to_public_key, $amount);
        $response = $response->getResponse();

        Log::debug('transaction', $response);

        return $response;
    }
}
