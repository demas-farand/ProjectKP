<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
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
                'username' => 'admin1',
                'role' => 'Admin',
                'password' => bcrypt('123456')
            ]
        ];

        foreach ($userData as $val) {
            // Cek apakah pengguna sudah ada
            $user = User::where('email', $val['email'])->first();

            if (!$user) {
                // Buat pengguna baru jika belum ada
                $user = User::create([
                    'name' => $val['name'],
                    'email' => $val['email'],
                    'username' => $val['username'],
                    'password' => $val['password'],
                ]);

                // Kaitkan peran ke pengguna
                $role = Role::where('name', $val['role'])->first();
                if ($role) {
                    $user->assignRole($role);
                }
            }
        }
    }
}
