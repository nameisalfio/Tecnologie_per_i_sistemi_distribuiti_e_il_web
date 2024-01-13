<?php

namespace App\Http\Controllers;

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

        return redirect('/read');
    }

    public function update()
    {
        DB::table('books')->where('isbn', $_POST['isbn'])->update([
            'titolo' => $_POST['titolo'],
            'autore' => $_POST['autore'],
            'prezzo' => $_POST['prezzo'],
        ]);

        return redirect('/read');
    }

    public function delete()
    {
        DB::table('books')->where('isbn', $_POST['isbn'])->delete();

        return redirect('/read');
    }
}
