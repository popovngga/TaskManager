<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('login');

Route::get('login/{provider}',
           [\App\Http\Controllers\SocialController::class, 'redirect']);
Route::get('{provider}/callback',
           [\App\Http\Controllers\SocialController::class, 'callback']);

Route::get('/home', function () {
  return view('home');
})->name('home');

