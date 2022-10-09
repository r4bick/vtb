<?php

namespace Database\Factories;

use App\Constants\GradeUserStatus;
use App\Models\GradeUser;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class GradeUserFactory extends Factory
{
    protected $model = GradeUser::class;
    public static array $stubGradeUser = [
        [
            'grade_id' => '1a3a9d78-bea7-44c0-820e-fe97ed338139',
            'status' => GradeUserStatus::DONE,
            'end_at' => '2020-08-30 00:00',
            'progress' => [
                'course' => 4,
                'task' => 5,
            ]
        ],
        [
            'grade_id' => '7c552605-b84c-4b50-8549-509f2228c39c',
            'status' => GradeUserStatus::DONE,
            'end_at' => '2021-03-30 00:00',
            'progress' => [
                'course' => 6,
                'task' => 8,
            ]
        ],
        [
            'grade_id' => '4163321a-5757-4175-9ed3-47aed40103f9',
            'status' => GradeUserStatus::DONE,
            'end_at' => '2022-01-21 00:00',
            'progress' => [
                'course' => 8,
                'task' => 10,
            ]
        ],
        [
            'grade_id' => '3ca829bd-3c55-43c5-a4c9-f55941c2aa4d',
            'status' => GradeUserStatus::IN_PROGRESS,
            'progress' => [
                'course' => 8,
                'task' => 10,
            ]
        ],
        [
            'grade_id' => '2c52302f-ce5e-4345-bb60-ee6f299ce75c',
            'status' => GradeUserStatus::IN_PROGRESS,
            'progress' => [
                'course' => 0,
                'task' => 0,
            ]
        ]
    ];

    public function definition()
    {
        return [
            'id' => Str::uuid(),
        ];
    }
}
