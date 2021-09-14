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
            'restaurant_id'  => $this->faker->randomElement($restaurants),
            'queue_status' => $this->faker->randomElement(array_keys(QueueStatus::STATUSES)),
        ];
    }
}
