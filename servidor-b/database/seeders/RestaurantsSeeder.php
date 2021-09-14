<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Seeder;

class RestaurantsSeeder extends Seeder
{
    public function run()
    {
        Restaurant::factory()->create([
            'name' => 'Central'
        ]);

        Restaurant::factory()->create([
            'name' => 'Setor IV'
        ]);
    }
}
