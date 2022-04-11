<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Http;

use App\Services\WmataApi;

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

Route::get('/station', function(WmataApi $api) {
    return $api->getStationList();
});

Route::get('/station/{id}', function($id, WmataApi $api) {
    $next_trains = $api->getNextTrains($id);
    return $next_trains;
});
