<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        $this->call(UserTableSeeder::class);
//        $this->call(DepartureTableSeeder::class);
//        $this->call(AccountTableSeeder::class);
//        $this->call(TaskTableSeeder::class);
//        $this->call(TaskDepartureTableSeeder::class);
//        $this->call(TaskUserTableSeeder::class);
        $this->call(ProductTableSeeder::class);
    }
}
