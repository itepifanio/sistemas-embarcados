<?php

namespace Database\Factories;

use App\Models\Restaurant;
use App\Models\QueueStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class QueueStatusFactory extends Factory
{
    protected $model = QueueStatus::class;

    public function definition()
    {
        $restaurants = Restaurant::all()->pluck('id')->toArray();

        return [
            'camera_name' => 'Camera ' . $this->faker->randomDigit(),
            'restaurant_id'  => $this->faker->randomElement($restaurants),
            'camera_status' => $this->faker->randomElement(array_keys(QueueStatus::STATUSES)),
        ];
    }
}
