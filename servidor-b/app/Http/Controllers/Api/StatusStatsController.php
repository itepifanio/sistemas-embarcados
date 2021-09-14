<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\StatusStats;

class StatusStatsController extends Controller
{
    public function __invoke($id, StatusStats $service)
    {
        return response()->json($service->getStats($id));
    }
}
