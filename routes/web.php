<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[App\Http\Controllers\BookController::class, 'index'])->name('home');
Route::post('/book/save', [App\Http\Controllers\BookController::class, 'save_book'])->name('save_book');
Route::get('/book/delete/{id}',[App\Http\Controllers\BookController::class, 'delete_book'])->name('delete_book');

