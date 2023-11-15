<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Pimpinan',
            'username' => 'pimpinan',
            'role' => 'PIMPINAN',
            'email' => 'pimpinan@gmail.com',
            'password' => Hash::make('pimpinan')
        ]);
    }
}
