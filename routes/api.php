<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Http;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::get('/station', function() {
    $API_KEY = $_ENV['WMATA_API_KEY'];
    $WMATA_API_URI = 'https://api.wmata.com/Rail.svc/json';
    try {
        $res = Http::withHeaders([
            'api_key' => $API_KEY
        ])->get("$WMATA_API_URI/jStations");
        return $res->body();
    } catch(Exception $e) {
        return $e->getMessage();
    }
});