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

Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::get('current',
               [\App\Http\Controllers\SocialController::class, 'current']);
    Route::get('logout',
               [\App\Http\Controllers\SocialController::class, 'logout']);
    Route::post('task/create',
               [\App\Http\Controllers\TaskController::class, 'createTask']);
    Route::patch('task/change/{id}',
                [\App\Http\Controllers\TaskController::class, 'changeStatus']);

});
