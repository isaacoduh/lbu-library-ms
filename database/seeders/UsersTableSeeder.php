<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed an admin user
        User::create([
            'username' => 'admin',
            'password' => bcrypt('12345678'), // Replace with the desired password
            'role' => 'admin',
            'password_changed' => true, // Set password_changed to true for admin
        ]);

        // Seed a regular user with password_changed = false
        User::create([
            'username' => 'c12345601',
            'password' => bcrypt('000000'), // Replace with the desired password
            'role' => 'user',
            'password_changed' => true, // Set password_changed to true for user 2
        ]);

        // Seed a regular user with password_changed = true
        User::create([
            'username' => 'c12345602',
            'password' => bcrypt('000000'), // Replace with the desired password
            'role' => 'user',
            'password_changed' => false, // Set password_changed to true for user 2
        ]);
    }
}
