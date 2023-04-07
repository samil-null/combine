<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->as('api.')->group(static function () {
    Route::apiResource('events', \App\Http\Controllers\Api\Events\EventController::class)->names('events');
    Route::apiResource('events.properties', \App\Http\Controllers\Api\Events\Properties\PropertyController::class)->names('events.properties');
});
