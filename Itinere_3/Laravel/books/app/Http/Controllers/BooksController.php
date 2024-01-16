<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{

    public function read()
    {
        return view('read', ['books' => Book::all()]);
    }

    public function create(Request $request)
    {
        Book::create($request->all());
        return redirect('/read');
    }

    public function form(Request $request)
    {
        if ($request->input("action") === "Modifica")
        {
            return view('update', ['book' => (object)$request->all()]);
        }

        if ($request->input("action") === "Rimuovi")
        {
            $book = Book::find($request->input('isbn'));
            $book->delete();
        }

        return redirect('/read');
    }

    public function update(Request $request)
    {
        $book = Book::find($request->input('isbn'));
        $book->update($request->all()); // Simile all'insert
        return redirect('/read');
    }
}
