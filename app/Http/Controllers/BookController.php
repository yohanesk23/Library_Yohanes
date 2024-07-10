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

    /**
    * Display a list of books.
    *
    * If a search query is provided, filter books by title or author.
    * Otherwise, retrieve all books. Pass the books and a title to the view.
    *
    * @param Request $request The incoming request object.
    * @return \Illuminate\View\View The view displaying the list of books.
    */
    public function index(Request $request)
    {
        // Check if there is a search query in the request
        if ($request->search) {
            // Search for books by title or author matching the search query
            $books = Book::where('title', 'like', '%' . $request->search . '%')
                ->orWhere('author', 'like', '%' . $request->search . '%')
                ->get();
        } else {
            // Retrieve all books
            $books = Book::all();
        }
        // Return the view with the list of books and the page title
        return view('books.index', compact('books'))->with('title', 'Book List');
    }

    /**
    * Delete a book from the database.
    *
    * Finds the book by ID from the request and attempts to delete it.
    * Redirects back with a success message if successful,
    * or with an error message if an exception occurs.
    *
    * @param Request $request The incoming request object.
    * @return \Illuminate\Http\RedirectResponse Redirects back with a message.
    */
    public function delete_book(Request $request)
    {
        try {
            // Find the book by ID and delete it
            $book = Book::find($request->id);
            $book->delete();
            // Redirect back with a success message
            return back()->with('message', array('result' => "Book has been deleted successfully", 'class' => "success"));
        } catch (\Exception $e) {
            // Redirect back with an error message
            return back()->with('message', array('result' => $e->getMessage(), 'class' => "danger"));
        }
    }

    /**
    * Display the edit form for a book.
    *
    * Finds the book by ID from the request and passes it to the view.
    *
    * @param Request $request The incoming request object.
    * @return \Illuminate\View\View The view displaying the edit form.
    */
    public function edit_book(Request $request)
    {
        // Find the book by ID
        $book = Book::find($request->id);
        // Return the view with the book data and the page title
        return view('books.edit', ['book' => $book])->with('title', 'Edit Book');
    }

    /**
    * Update a book in the database.
    *
    * Validates the request data, finds the book by ID, updates its title and author,
    * and saves the changes to the database. Redirects back with a success message if successful,
    * or with an error message if an exception occurs.
    *
    * @param Request $request The incoming request object.
    * @return \Illuminate\Http\RedirectResponse Redirects back with a message.
    */
    public function update_book(Request $request)
    {
        try {
            // Validate the request data
            $request->validate([
                'title' => 'required',
                'author' => 'required',
            ]);
            // Find the book by ID and update its title and author
            $save = Book::find($request->id);
            $save->title = $request->title;
            $save->author = $request->author;
            $save->save();
            // Redirect back with a success message
            return back()->with('message', array('result' => "Book has been updated successfully", 'class' => "success"));
        } catch (\Exception $e) {
            // Redirect back with an error message
            return back()->with('message', array('result' => $e->getMessage(), 'class' => "danger"));
        }
    }

    /**
    * Export books data to CSV or XML.
    *
    * Validates the request data, retrieves all books, and exports the data to the specified format.
    * Returns a download response with the exported file.
    *
    * @param Request $request The incoming request object.
    * @return \Illuminate\Http\Response The response containing the download.
    */
    public function export_to_csv_or_xml(Request $request)
    {
        // Validate the request data
        $request->validate([
            'fields' => 'required|array|min:1',
            'export_type' => 'required|string|in:csv,xml',
        ]);

        // Retrieve all books
        $books = Book::all();
        $fields = $request->fields;
        $exportType = $request->export_type;

        // Handle CSV export
        if ($exportType == 'csv') {
            $filename = 'books.csv';
            $handle = fopen($filename, 'w+');

            // Write header
            fputcsv($handle, $fields);

            // Write data rows
            foreach ($books as $book) {
                $data = [];
                foreach ($fields as $field) {
                    $data[] = $book->$field;
                }
                fputcsv($handle, $data);
            }

            fclose($handle);

            $headers = [
                'Content-Type' => 'text/csv',
            ];

            return response()->download($filename, 'books.csv', $headers);

        // Handle XML export
        } else if ($exportType == 'xml') {
            $xml = new \SimpleXMLElement('<books/>');

            foreach ($books as $book) {
                $bookXml = $xml->addChild('book');
                foreach ($fields as $field) {
                    $bookXml->addChild($field, $book->$field);
                }
            }

            $filename = 'books.xml';
            $xml->asXML($filename);

            $headers = [
                'Content-Type' => 'text/xml',
            ];

            return response()->download($filename, 'books.xml', $headers);
        }
    }
}
