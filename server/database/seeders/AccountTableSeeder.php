<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Departure;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class AccountTableSeeder extends Seeder
{

    public function run(): void
    {
        $users = User::all()->toArray();
        Account::factory()
            ->count(count($users))
            ->state(new Sequence(
                fn (Sequence $sequence) => [
                    'id' => $users[$sequence->index]['id'],
                    'departure_id' => Departure::all()->random()->id,
                ],)
            )
            ->create();
    }
}
