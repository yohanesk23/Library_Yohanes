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

    public function index(Request $request)
    {
        if ($request->search) {
            $books = Book::where('title', 'like', '%' . $request->search . '%')
                ->orWhere('author', 'like', '%' . $request->search . '%')
                ->get();
        } else {
            $books = Book::all();
        }
        return view('books.index', compact('books'))->with('title', 'Book List');
    }

    public function delete_book(Request $request)
    {
        try {
            $book = Book::find($request->id);
            $book->delete();
            return back()->with('message', array('result' => "Book has been deleted successfully", 'class' => "success"));
        } catch (\Exception $e) {
            return back()->with('message', array('result' => $e->getMessage(), 'class' => "danger"));
        }
    }

    public function edit_book(Request $request)
    {
        $book = Book::find($request->id);
        return view('books.edit', ['book' => $book])->with('title', 'Edit Book');
    }

    public function update_book(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required',
                'author' => 'required',
            ]);
            $save = Book::find($request->id);
            $save->title = $request->title;
            $save->author = $request->author;
            $save->save();
            return back()->with('message', array('result' => "Book has been updated successfully", 'class' => "success"));
        } catch (\Exception $e) {
            return back()->with('message', array('result' => $e->getMessage(), 'class' => "danger"));
        }
    }

    public function export_to_csv_or_xml(Request $request)
    {
        $request->validate([
            'fields' => 'required|array|min:1',
            'export_type' => 'required|string|in:csv,xml',
        ]);

        $books = Book::all();
        $fields = $request->fields;
        $exportType = $request->export_type;

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
