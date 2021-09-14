<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use App\Models\QueueStatus;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    public const NUM_CAMERAS = 10;

    public const NUM_REQUESTS = 10; // number of requests send by server A

    public function run()
    {
        $restaurants = Restaurant::all()->pluck('id')->toArray();
        for($i = 1; $i <= self::NUM_REQUESTS; $i++) {
            for ($j = 1; $j <= self::NUM_CAMERAS; $j++) {
                QueueStatus::factory()->create([
                    'camera_name' => 'Camera' . $j,
                    'restaurant_id'  => $j < 6 ? $restaurants[0] : $restaurants[1],
                ]);
            }
        }
    }
}
