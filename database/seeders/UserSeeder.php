<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Author;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // id = 1
        User::create([
            'name' => 'Artem',
            'email' => 'a@a.ru',
            'password' => Hash::make('a'),
            'role_id' => 2
        ]);

        // id = 2
        User::create([
            'name' => 'Alina',
            'email' => 'b@a.ru',
            'password' => Hash::make('a'),
            'role_id' => 2
        ]);

        // id = 3
        $alex = User::create([
            'name' => 'Alex',
            'email' => 'c@a.ru',
            'password' => Hash::make('a'),
            'role_id' => 3
        ]);

        // id = 1
        Author::create([
            'user_id' => $alex->id
        ]);

        // id = 4
        $misha = User::create([
            'name' => 'Misha',
            'email' => 'd@a.ru',
            'password' => Hash::make('a'),
            'role_id' => 3
        ]);

        // id = 2
        Author::create([
            'user_id' => $misha->id
        ]);
    }
}
