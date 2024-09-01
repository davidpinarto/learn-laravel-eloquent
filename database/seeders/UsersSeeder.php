<?php

namespace Database\Seeders;

use App\Models\Users;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usersPayload = [
            [
                'id' => "user-" . Str::random(16),
                'email' => "davidpinarto90@gmail.com",
                'password' => Hash::make('david'),
                'full_name' => 'david pinarto',
            ],
            [
                'id' => "user-" . Str::random(16),
                'email' => "testing@gmail.com",
                'password' => Hash::make('david'),
                'full_name' => 'testing',
            ],
            [
                'id' => "user-" . Str::random(16),
                'email' => "testong@gmail.com",
                'password' => Hash::make('david'),
                'full_name' => 'testong',
            ]
        ];

        foreach ($usersPayload as $userData) {
            Users::create($userData);
        }
    }
}
