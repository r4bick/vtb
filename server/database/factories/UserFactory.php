<?php

namespace Database\Factories;

use App\Constants\UserStatuses;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = User::class;
    public static array $stubEmails = [
        'edenesik@example.com',
        'effertz.stella@example.com',
        'marty.dooley@example.net',
        'gtreutel@example.org',
        'tatum.lesch@example.net',
        'kovacek.vivien@example.org',
        'zheller@example.com',
        'juana.sipes@example.com',
        'rey39@example.net',
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
            'email' => $this->faker->unique()->safeEmail,
            'status' => $this->faker->randomElement(UserStatuses::toArray()),
        ];
    }
}
