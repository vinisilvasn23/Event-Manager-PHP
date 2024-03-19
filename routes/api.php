<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('users')->group(function () {
    Route::post('/', [UserController::class, 'create']);
    Route::middleware('jwt.verify')->get('/', [UserController::class, 'getUser']);
    Route::middleware('jwt.verify', 'check.user')->patch('/{id}', [UserController::class, 'updateUser']);
    Route::middleware('jwt.verify', 'check.user')->delete('/{id}', [UserController::class, 'deleteUser']);
    Route::middleware('jwt.verify', 'check.user')->get('/{id}', [UserController::class, 'getUserById']);
});

Route::prefix('events')->group(function () {
    Route::middleware('jwt.verify')->post('/', [EventController::class, 'create']);
    Route::get('/', [EventController::class, 'getEvent']);
    Route::get('/{id}', [EventController::class, 'getEventById']);
    Route::middleware('jwt.verify')->patch('/{id}', [EventController::class, 'updateEvent']);
    Route::middleware('jwt.verify')->delete('/{id}', [EventController::class, 'deleteEvent']);
    Route::middleware('jwt.verify')->post('/{id}/enroll', [EventController::class, 'enrollUser']);
    Route::middleware('jwt.verify')->get('/{id}/participants', [EventController::class, 'getEventParticipants']);
});

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('/login', [AuthController::class, 'login']);
});
