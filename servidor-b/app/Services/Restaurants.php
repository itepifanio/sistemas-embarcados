<?php

namespace App\Services;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class Restaurants
{
    protected Builder $query;

    public function __construct()
    {
        $this->query = Restaurant::query();
    }

    public function getRestaurants(): Collection
    {
        return $this->query->get();   
    }
}
