<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/


Route::get('/events', [EventController::class, 'index']);
Route::post('/events', [EventController::class, 'store'])->middleware('role:admin');
Route::put('/events/{id}', [EventController::class, 'update'])->middleware('role:admin');
Route::delete('/events/{id}', [EventController::class, 'destroy'])->middleware('role:admin');
Route::post('/events/{id}/rsvp', [EventController::class, 'rsvp']);


Route::get('/user', [UserController::class, 'show']);
Route::put('/user', [UserController::class, 'update']);
