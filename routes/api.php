<?php

use Illuminate\Support\Facades\Route;
use TheRealJanJanssens\BookingCore\Controllers\API\V1\AvailabilityController;

// API routes
Route::group([
    'prefix' => config('booking-core.api.prefix'),
    'middleware' => config('booking-core.api.middleware'),
], function () {
    Route::get('/availability', AvailabilityController::class);
});

// Authenticated API routes
Route::group([
    'prefix' => config('booking-core.api.prefix'),
    'middleware' => config('booking-core.api.auth_middleware'),
], function () {
   // Route::get('/private-call', [Controller::class, 'index']);
});
