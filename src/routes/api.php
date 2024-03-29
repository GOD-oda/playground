<?php

use Illuminate\Http\Request;
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

Route::get('healthcheck', function () {
    return response()->json();
});

Route::prefix('json_to_code')->name('json_to_code.')->group(function () {
    Route::post('/run', \App\Http\Controllers\Api\JsonToCode\RunController::class)->name('run');
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('exception', function () {
    throw new Exception('test', 500);
});
