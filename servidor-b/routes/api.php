<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebhookController;
use App\Http\Controllers\Api\StatusStatsController;

Route::post('webhook', WebhookController::class)->name('webhook');

Route::middleware('auth:sanctum')->get('/que', function (Request $request) {
    return $request->user();
});

Route::name('api.')
    ->group(function () {
        Route::get('queue-status', StatusStatsController::class)->name('queue-status');
        Route::post('queue-status/', [StatusStatsController::class, 'store'])->name('queue-status-store');
    });
