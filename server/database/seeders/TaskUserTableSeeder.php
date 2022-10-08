<?php

namespace Database\Seeders;

use App\Constants\TaskTypes;
use App\Models\Task;
use App\Models\TaskUser;
use App\Models\User;
use Illuminate\Database\Seeder;

class TaskUserTableSeeder extends Seeder
{

    public function run(): void
    {
        $users = User::all();
        $tasks = Task::whereType(TaskTypes::USER)->get();
        for ($i = 0; $i < random_int(1, count($tasks)) - 1; $i++) {
            /** @var Task $task */
            $task = $tasks[$i];
            TaskUser::factory()
                ->create([
                    'user_id' => $users->random()->value('id'),
                    'task_id' => $task->id,
                ]);
        }
    }
}
