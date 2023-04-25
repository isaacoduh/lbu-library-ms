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

Auth::routes();

Route::middleware(['auth','password.change'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('password/change', [App\Http\Controllers\Auth\PasswordController::class,'showChangeForm'])->name('password.change.form');
    
    Route::post('/password/change', [App\Http\Controllers\Auth\PasswordController::class,'change'])->name('password.change.submit');
});


