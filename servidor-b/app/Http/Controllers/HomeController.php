<?php

namespace App\Http\Controllers;

use App\Models\QueueStatus;
use Illuminate\Http\Request;
use App\Services\Restaurants;
use App\Services\StatusStats;

class HomeController extends Controller
{   
    public Restaurants $restaurantsService;
    public StatusStats $statusStatsService;

    public function __construct(Restaurants $restaurantsService, StatusStats $statusStatsService)
    {
        $this->restaurantsService = $restaurantsService;
        $this->statusStatsService =  $statusStatsService;
    }

    /**
     * Show the application home.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $restaurants = $this->restaurantsService->getRestaurants();
        
        $restaurants->map(function ($restaurant, $key) {
            $restaurant->status = QueueStatus::STATUSES[$this->statusStatsService->getQueueUnifiedStatus($restaurant->id)];
            return $restaurant;
        });

        return view('home', ['restaurants' => $restaurants]);
    }
}
