<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class RoleFactory extends Factory
{
    protected $model = Role::class;
    public static array $stubRoles = [
        ['role_id' => 'user'],
        ['role_id' => 'admin'],
    ];

    public function definition(): array
    {
        return [
            'id' => Str::uuid(),
        ];
    }
}
