<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'email' => 'admin@admin.com' ,
                'username' => 'adminuser',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'email' => 'karyawan1@karyawan.com',
                'username' => 'karyawan1',
                'password' => Hash::make('karyawan123'),
                'role' => 'karyawan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'email' => 'karyawan2@karyawan.com',
                'username' => 'karyawan2',
                'password' => Hash::make('karyawan456'),
                'role' => 'karyawan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
