<?php

namespace Database\Seeders;

use App\Models\Grade;
use App\Models\GradeUser;
use App\Models\User;
use Database\Factories\GradeUserFactory;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class GradeUserSeeder extends Seeder
{

    public function run(): void
    {
        $users = User::all()->toArray();
        for ($i = 0; $i < count($users); $i++) {
            foreach (GradeUserFactory::$stubGradeUser as $grade) {
                GradeUser::factory()
                    ->state(new Sequence(
                        fn (Sequence $sequence) => [
                            'user_id' => $users[$i]['id']
                        ],
                    ))
                    ->create($grade);
            }
        }
    }
}
