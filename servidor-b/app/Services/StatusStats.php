<?php

namespace App\Services;

use App\Models\Restaurant;
use App\Models\QueueStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class StatusStats
{
    protected Builder $query;

    public function __construct()
    {
        $this->query = QueueStatus::query();
    }

    public function getStats(): Collection
    {
        return $this->query
            ->with('restaurant:id,name')
            ->orderByDesc('id')
            ->take(10)
            ->get()
            ->groupBy('restaurant.name');
    }

    public function getCameraNames(): array
    {
        return $this->query
            ->select('camera_name')
            ->distinct('camera_name')
            ->get()
            ->all();
    }
}
