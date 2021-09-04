<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
         User::factory()->create([
             'email' => 'test@gmail.com',
             'password' => Hash::make('password'),
         ]);
    }
}
