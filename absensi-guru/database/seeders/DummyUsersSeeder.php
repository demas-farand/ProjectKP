<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'name' => 'Admin1',
                'email' => 'admin1@gmail.com',
                'username' => 'admin1', // Pastikan username diisi dan unik
                'role' => 'Admin', // Sesuaikan dengan constraint
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'User1',
                'email' => 'user1@gmail.com',
                'username' => 'user1', // Pastikan username diisi dan unik
                'role' => 'User', // Sesuaikan dengan constraint
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Guru1',
                'email' => 'guru1@gmail.com',
                'username' => 'guru1', // Pastikan username diisi dan unik
                'role' => 'Guru', // Sesuaikan dengan constraint
                'password' => bcrypt('123456')
            ],
        ];

        foreach ($userData as $key => $val) {
            User::create($val);
        }
    }
}
