<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    public function __invoke()
    {
        Log::info('Received notification.');

        return response()->json([
           'success' => 'Notification received with success',
        ]);
    }
}
