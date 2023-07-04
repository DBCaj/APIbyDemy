<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach(range(1, 10) as $index) {
            DB::table('members')
            ->insert([
               'name' => $faker->name,
               'age' => mt_rand(18, 65),
               'email' => $faker->email,
               'password' => Hash::make($faker->password), 
            ]);
        }
    }
}
