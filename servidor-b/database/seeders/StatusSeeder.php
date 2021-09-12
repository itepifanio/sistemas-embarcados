<?php

namespace Database\Seeders;

use App\Models\QueueStatus;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    public const NUM_CAMERAS = 10;

    public const NUM_REQUESTS = 10; // number of requests send by server A

    public function run()
    {
        for($i = 1; $i <= self::NUM_REQUESTS; $i++) {
            for ($j = 1; $j <= self::NUM_CAMERAS; $j++) {
                QueueStatus::factory()->create([
                    'camera_name' => 'Camera' . $j,
                ]);
            }
        }
    }
}
