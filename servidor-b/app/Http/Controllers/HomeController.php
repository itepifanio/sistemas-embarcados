<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Restaurants;

class HomeController extends Controller
{   
    public Restaurants $service;

    public function __construct(Restaurants $service)
    {
        $this->service = $service;
    }

    /**
     * Show the application home.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        return view('home', ['restaurants' => $this->service->getRestaurants()]);
    }
}
