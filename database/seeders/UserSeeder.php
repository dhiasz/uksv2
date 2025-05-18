<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash; // Pastikan untuk import Hash

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       User::insert([
        [
            'username' => 'admin',
            'password' => Hash::make('admin'),
        ],
        [
            'username' => 'sekretaris',
            'password' => Hash::make('sekretaris'),
        ],
        [
            'username' => 'ketua',
            'password' => Hash::make('ketua'),
        ],
    ]);

    }
}