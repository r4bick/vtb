<?php

namespace Database\Factories;

use App\Models\Grade;
use Illuminate\Database\Eloquent\Factories\Factory;

class GradeFactory extends Factory
{
    protected $model = Grade::class;
    public static array $stubGrade = [
        [
            'id' => '1a3a9d78-bea7-44c0-820e-fe97ed338139',
            'name' => 'Java-разработчик стажер',
            'condition' => [
                'course' => 4,
                'task' => 5,
            ],
        ],
        [
            'id' => '7c552605-b84c-4b50-8549-509f2228c39c',
            'name' => 'Java-разработчик джуниор категория 1',
            'condition' => [
                'course' => 6,
                'task' => 8,
            ],
        ],
        [
            'id' => '4163321a-5757-4175-9ed3-47aed40103f9',
            'name' => 'Java-разработчик джуниор категория 2',
            'condition' => [
                'course' => 8,
                'task' => 10,
            ],
        ],
        [
            'id' => '3ca829bd-3c55-43c5-a4c9-f55941c2aa4d',
            'name' => 'Java-разработчик джуниор категория 3',
            'condition' => [
                'course' => 10,
                'task' => 15,
                'article' => 2,
                'meetup' => 3,
            ],
        ],
        [
            'id' => '2c52302f-ce5e-4345-bb60-ee6f299ce75c',
            'name' => 'Java-разработчик мидл категория 1',
            'condition' => [
                'course' => 12,
                'task' => 20,
            ],
        ],
    ];

    public function definition(): array
    {
        return [];
    }
}
