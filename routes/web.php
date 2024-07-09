<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('index');
});

Route::post('/book/save', [App\Http\Controllers\BookController::class, 'save_book'])->name('save_book');

