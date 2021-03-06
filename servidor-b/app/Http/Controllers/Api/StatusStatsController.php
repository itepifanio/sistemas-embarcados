<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\StatusStats;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\QueueStatus;

class StatusStatsController extends Controller
{
    public function __invoke(StatusStats $service)
    {
        return response()->json($service->getStats());
    }

    public function store(Request $request)
    {
        foreach($request->all() as $status) {
            $restaurant = Restaurant::find($status['restaurant_id']);

            $queueStatus = new QueueStatus();
            $queueStatus->queue_status = $status['queue_status'];
            $queueStatus->restaurant_id = $restaurant->id;
            $queueStatus->save();
        }

        return response()->json([
            "message" => "Status atualizados com sucesso!"
        ]);
    }
}
