<?php

namespace App\Services;

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
            ->orderByDesc('id')
            ->take(10) // 10 is the number of cameras used in this project how to avoid hard coded here?
            ->get();
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
