<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Database\Factories\TaskFactory;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class TaskTableSeeder extends Seeder
{

    public function run(): void
    {
        $users = User::all();
        foreach (TaskFactory::$stubTasks as $attributes) {
            $attributes['begin_at'] = Carbon::make($attributes['begin_at'])->toDateTimeString();
            $attributes['end_at'] = Carbon::make($attributes['end_at'])->toDateTimeString();
            Task::factory()
                ->state(new Sequence(
                        fn (Sequence $sequence) => [
                            'author_id' => $users->random()->value('id'),
                            'validator_id' => $users->random()->value('id'),
                        ],)
                )
                ->create($attributes);
        }
    }
}
