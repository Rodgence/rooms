<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RoomController;

// Public API routes
Route::get('/rooms', [RoomController::class, 'index'])->middleware('throttle.api');
