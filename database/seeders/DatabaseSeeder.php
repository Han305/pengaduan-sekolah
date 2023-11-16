<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {        
        \App\Models\User::create([
            'name' => 'Test',
            'username' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('123'),
            'category' => 'user'
        ]);
        \App\Models\User::create([
            'name' => 'admin',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('123'),
            'category' => 'admin'
        ]);
    }
}