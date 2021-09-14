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

    public function getStats($id): Collection
    {
        return $this->query
            ->where('restaurant_id', $id)
            ->orderByDesc('id')
            ->take(5)
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

    public function getQueueUnifiedStatus($id){
        $current = $this->getStats($id);

        return 2;
    }
}
