<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'firstName' => 'Constril',
            'lastName' => 'Materiais',
            'email' => 'constril@gmail.com',
            'password' => bcrypt('constril123'),
            'access_level' => 'admin',
        ]);
    }
}
