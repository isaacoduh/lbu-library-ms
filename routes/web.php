<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('force.change');
Route::get('/password/change', [App\Http\Controllers\Auth\PasswordController::class,'show'])->name('password.change');
Route::post('/password/change', [App\Http\Controllers\Auth\PasswordController::class,'change'])->name('password.change.submit');

Route::get('/books',[App\Http\Controllers\BookController::class,'index'])->middleware('auth')->name('books.index');
Route::get('/transaction/borrow',[App\Http\Controllers\TransactionController::class,'borrowForm'])->middleware('auth')->name('transaction.borrow');
Route::post('/transaction/borrow',[App\Http\Controllers\TransactionController::class,'borrowFormSubmit'])->middleware('auth')->name('transaction.borrow.submit');

Route::get('/transaction/returnbook',[App\Http\Controllers\TransactionController::class,'returnBookForm'])->middleware('auth')->name('transaction.returnbook');

Route::post('/transaction/returnbook',[App\Http\Controllers\TransactionController::class,'returnBookFormSubmit'])->middleware('auth')->name('transaction.returnbook.submit');

// Route::middleware(['auth','force.change'])->group(function () {
    
   
    
    
    
// });


