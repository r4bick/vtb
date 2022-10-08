<?php

namespace Database\Seeders;

use App\Models\Departure;
use App\Models\User;
use Database\Factories\DepartureFactory;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class DepartureTableSeeder extends Seeder
{

    public function run(): void
    {
        Departure::factory()
            ->count(count(DepartureFactory::$stubNames))
            ->state(new Sequence(
                fn (Sequence $sequence) => [
                    'head_id' => User::all()->random()->id,
                    'name' => DepartureFactory::$stubNames[$sequence->index],
                ],
            ))
            ->create();
    }
}
