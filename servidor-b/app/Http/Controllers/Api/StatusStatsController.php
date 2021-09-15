<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\StatusStats;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\QueueStatus;
use Illuminate\Support\Facades\Log;

class StatusStatsController extends Controller
{
    public function __invoke($id, StatusStats $service)
    {
        return response()->json($service->getStats($id));
    }

    public function store(Request $request)
    {
        Log::info($request->all());
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
