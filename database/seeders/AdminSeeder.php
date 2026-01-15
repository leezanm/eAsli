<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin eAsli',
            'email' => 'admin@easli.com',
            'password' => Hash::make('admin123456'),
            'email_verified_at' => now(),
        ]);
    }
}
