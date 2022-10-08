<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{

    public function run(): void
    {
        User::factory()
            ->count(count(UserFactory::$stubEmails))
            ->state(new Sequence(
                fn (Sequence $sequence) => [
                    'email' => UserFactory::$stubEmails[$sequence->index],
                ],)
            )
            ->create([
                'password' => '123456',
            ]);
    }
}
