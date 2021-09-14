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

         // to test the application before the server A be ready to send the actual information.
        (new StatusSeeder())->run();
        (new RestaurantsSeeder())->run();
    }
}
