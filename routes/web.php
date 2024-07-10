<?php

use Illuminate\Support\Facades\Route;

// Route for the homepage, which will use the index method of the BookController
Route::get('/', [App\Http\Controllers\BookController::class, 'index'])->name('home');

// Route to save a new book, which will use the save_book method of the BookController
Route::post('/book/save', [App\Http\Controllers\BookController::class, 'save_book'])->name('save_book');

// Route to delete a book by its ID, which will use the delete_book method of the BookController
Route::get('/book/delete/{id}', [App\Http\Controllers\BookController::class, 'delete_book'])->name('delete_book');

// Route to edit a book by its ID, which will use the edit_book method of the BookController
Route::get('/book/edit/{id}', [App\Http\Controllers\BookController::class, 'edit_book'])->name('edit_book');

// Route to update a book's information, which will use the update_book method of the BookController
Route::post('/book/update', [App\Http\Controllers\BookController::class, 'update_book'])->name('update_book');

// Route to export books data to CSV or XML, which will use the export_to_csv_or_xml method of the BookController
Route::post('export', [App\Http\Controllers\BookController::class, 'export_to_csv_or_xml'])->name('export_to_csv_or_xml'); 
