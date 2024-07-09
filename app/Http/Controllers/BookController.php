<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{

    /**
    * Save a new book to the database.
    *
    * Validates the request data, creates a new Book instance, sets its title and author,
    * and saves it to the database. Redirects back with a success message if successful,
    *  or with an error message if an exception occurs.
    *
    * @param Request $request The incoming request object.
    * @return \Illuminate\Http\RedirectResponse Redirects back with a message.
    */
    public function save_book(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required',
                'author' => 'required',
            ]);
            $save = new Book();
            $save->title = $request->title;
            $save->author = $request->author;
            $save->save();
            return back()->with('message', array('result' => "Book has been saved successfully", 'class' => "success"));
        } catch (\Exception $e) {
            return back()->with('message', array('result' => $e->getMessage(), 'class' => "danger"));
        }
    }

}
