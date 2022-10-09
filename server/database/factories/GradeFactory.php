<?php

namespace Database\Factories;

use App\Models\Grade;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class GradeFactory extends Factory
{
    protected $model = Grade::class;
    public static array $stubGrade = [
        [
            'name' => 'Java-разработчик стажер',
            'condition' => [
                'course' => 4,
                'task' => 5,
            ],
        ],
        [
            'name' => 'Java-разработчик джуниор категория 1',
            'condition' => [
                'course' => 6,
                'task' => 8,
            ],
        ],
        [
            'name' => 'Java-разработчик джуниор категория 2',
            'condition' => [
                'course' => 8,
                'task' => 10,
            ],
        ],
        [
            'name' => 'Java-разработчик джуниор категория 3',
            'condition' => [
                'course' => 10,
                'task' => 15,
                'article' => 2,
                'meetup' => 3,
            ],
        ],
        [
            'name' => 'Java-разработчик мидл категория 1',
            'condition' => [
                'course' => 12,
                'task' => 20,
            ],
        ],
    ];

    public function definition(): array
    {
        return [
            'id' => Str::uuid(),
        ];
    }
}
