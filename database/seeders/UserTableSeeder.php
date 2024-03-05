<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        echo '---------------------------------------' . "\n";
        echo '--------User Seeding-------' . "\n";

        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
                // 'type' => 'Admin'
                // 'role' => 'Admin' // This assumes your role names are case-sensitive and exactly match 'Admin', 'Developer', etc.
            ],
            [
                'name' => 'Developer',
                'email' => 'developer@syscorp.in',
                'password' => Hash::make('password'),
                // 'type' => 'Admin'
                // 'role' => 'Developer'
            ]
        ];

        foreach ($users as $userData) {
            $user = User::create($userData);
            $user->assignRole('Admin');

            echo "-------Role not found for user: $user->name-------" . "\n";
        }
    }
}
