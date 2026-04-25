<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'Mon_Blog',
            'email'    => 'admin1@blog.com',
            'password' => Hash::make('password1'),
        ]);
    }
}