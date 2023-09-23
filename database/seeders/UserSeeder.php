<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'alamat' => 'Jl. Raya Cikarang',
            'nohp' => '081234567890',
            'level' => 'admin',
            'password' => bcrypt('admin@admin.com'),
        ]);
    }
}
