<?php

namespace Database\Factories;

use App\Models\QueueStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class QueueStatusFactory extends Factory
{
    protected $model = QueueStatus::class;

    public function definition()
    {
        return [
            'camera_name' => 'Camera ' . $this->faker->randomDigit(),
            'camera_status' => $this->faker->randomElement(array_keys(QueueStatus::STATUSES)),
        ];
    }
}
