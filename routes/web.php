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
});

Route::middleware(['auth'])->group(function () {
    Route::get('/', [App\Http\Controllers\BetterController::class, 'index']);
    Route::resource('horse', App\Http\Controllers\HorseController::class);
    Route::resource('betters', App\Http\Controllers\BetterController::class);
    Route::get('betters/{id}/record', [App\Http\Controllers\BetterController::class, 'record'])->name('betters.record');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
