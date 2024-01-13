<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

class FilmController extends Controller
{
    public function ReadAllFilms()
    {
        $films = DB::table("films")->get();
        return view("read", ["films" => $films]);
    }

    public function CreateFilm()
    {
        DB::table("films")->insert([
            "titolo" => $_POST["titolo"],
            "anno" => $_POST["anno"],
            "paese" => $_POST["paese"],
            "regista" => $_POST["regista"]
        ]);

        return redirect("/read");
    }

    public function UpdateFilm()
    {
        DB::table("films")->where("id", $_POST["id"])->update([
            "titolo" => $_POST["titolo"],
            "anno" => $_POST["anno"],
            "paese" => $_POST["paese"],
            "regista" => $_POST["regista"]
        ]);

        return redirect("/read");
    }

    public function DeleteFilm()
    {
        DB::table("films")->where("id", $_POST["id"])->delete();

        return redirect("/read");
    }
}
