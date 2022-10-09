<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Database\Factories\RoleFactory;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{

    public function run(): void
    {
        $users = User::all()->toArray();
        for ($i = 0; $i < count($users); $i++) {
            Role::factory()
                ->state(new Sequence(
                    fn (Sequence $sequence) => [
                        'user_id' => $users[$i]['id'],
                        'role_id' => RoleFactory::$stubRoles[intdiv(random_int(1, 10), 8)]['role_id'],
                    ],
                ))
                ->create();
        }
    }
}
