<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Seed only one user
        User::create([
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 1,
        ]);
    }
}
