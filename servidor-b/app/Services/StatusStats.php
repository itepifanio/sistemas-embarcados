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
        $cameras = $this->getStats($id);
        
        if($cameras->count() != 5){
            return 1;
        }

        //ver se tem forma melhor de fazer isso
        if($cameras[0]->camera_status != 5){
            return 1;
        }else if($cameras[0]->camera_status == 5 && $cameras[1]->camera_status != 5){
            return 2;
        }else if ($cameras[1]->camera_status == 5 && $cameras[2]->camera_status != 5 && $cameras[3]->camera_status != 5 ){
            return 3;
        }else if (($cameras[2]->camera_status == 5 || $cameras[3]->camera_status == 5) && $cameras[4]->camera_status != 5){
            return 4;
        }else if ($cameras[4]->camera_status == 5){
            return 5;
        }

    }
}
