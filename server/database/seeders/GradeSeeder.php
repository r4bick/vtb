<?php

namespace Database\Seeders;

use App\Models\Grade;
use Database\Factories\GradeFactory;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{

    public function run(): void
    {
        Grade::factory()
            ->count(count(GradeFactory::$stubGrade))
            ->state(new Sequence(
                function (Sequence $sequence) {
                    return GradeFactory::$stubGrade[$sequence->index];
                },
            ))
            ->create();
    }
}
