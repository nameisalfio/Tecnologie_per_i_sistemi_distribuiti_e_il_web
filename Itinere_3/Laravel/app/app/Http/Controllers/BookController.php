<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function read()
    {
        $books = DB::table('books')->get();
        
        return view('read', ['books' => $books]);
    }

    public function insert()
    {
        DB::table('books')->insert([
            'titolo' => $_POST['titolo'],
            'autore' => $_POST['autore'],
            'prezzo' => $_POST['prezzo'],
        ]);

        return redirect('/books')->with('success', 'Libro inserito con successo');
    }

    public function showForm()
    {
        $book = DB::table('books')->where('isbn', $_GET['isbn'])->first();
        
        return view('update', ['book' => $book]);
    }

    public function update()
    {
        $isbn = $_POST['isbn'];

        DB::table('books')->where('isbn', $isbn)->update([
            'titolo' => $_POST['titolo'],
            'autore' => $_POST['autore'],
            'prezzo' => $_POST['prezzo'],
        ]);

        return redirect('/books')->with('success', 'Libro aggiornato con successo');
    }

    public function delete()
    {
        DB::table('books')->where('isbn', $_POST['isbn'])->delete();

        return redirect('/books')->with('success', 'Libro rimosso con successo');
    }
}
