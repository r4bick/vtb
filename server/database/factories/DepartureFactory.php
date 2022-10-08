<?php

namespace Database\Factories;

use App\Models\Departure;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DepartureFactory extends Factory
{
    protected $model = Departure::class;
    public static array $stubNames = [
        'Прикладной разработки',
        'Программного обеспечения',
        'Backend-разработки',
        'Фронтенд-разработки',
    ];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'id' => Str::uuid(),
        ];
    }
}

