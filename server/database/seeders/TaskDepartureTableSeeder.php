<?php

namespace Database\Seeders;

use App\Constants\TaskTypes;
use App\Models\Departure;
use App\Models\Task;
use App\Models\TaskDeparture;
use Illuminate\Database\Seeder;

class TaskDepartureTableSeeder extends Seeder
{

    public function run(): void
    {
        $departures = Departure::all();
        $tasks = Task::whereType(TaskTypes::DEPARTURE)->get();
        for ($i = 0; $i < random_int(1, count($tasks)); $i++) {
            /** @var Task $task */
            $task = $tasks[$i];
            TaskDeparture::factory()
                ->create([
                    'departure_id' => $departures->random()->value('id'),
                    'task_id' => $task->id,
                ]);
        }
    }
}
