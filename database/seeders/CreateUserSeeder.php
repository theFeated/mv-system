<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class CreateUserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'User',
                'email' => 'user@user.com',
                'phone' => '1234',
                'password' => bcrypt('user123'),
                'role' => 0
            ],
            [
                'name' => 'Editor',
                'email' => 'editor@editor.com',
                'phone' => '1234',
                'password' => bcrypt('editor123'),
                'role' => 1
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'phone' => '1234',
                'password' => bcrypt('admin123'),
                'role' => 2
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
