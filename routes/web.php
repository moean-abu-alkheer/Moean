<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BooksController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('store');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('books')->name('books.')->middleware('auth')->group(function () {
    Route::get('/', [BooksController::class, 'index'])->name('index');
    Route::get('/create', [BooksController::class, 'create'])->name('create');
    Route::post('/store', [BooksController::class, 'store'])->name('store');
    Route::get('/{book}/edit', [BooksController::class, 'edit'])->name('edit');
    Route::put('/{book}/update', [BooksController::class, 'update'])->name('update');
    Route::put('/{book}/delete', [BooksController::class, 'destroy'])->name('destroy');

});


// Route::resource('books', BooksController::class);
