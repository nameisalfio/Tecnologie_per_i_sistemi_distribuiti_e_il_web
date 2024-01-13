<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

class MagazineController extends Controller
{
    public function read()
    {
        $products = DB::table("prodotti")->get();
        return view("read", ["products" => $products]);
    }

    public function insert()
    {
        DB::table("prodotti")->insert([
            "nome_prodotto" => $_POST["nome_prodotto"],
            "giacenza" => $_POST["giacenza"],
            "prezzo" => $_POST["prezzo"]
        ]);

        return redirect("/read");
    }

    public function update()
    {
        DB::table("prodotti")->where("id", $_POST["id"])->update([
            "nome_prodotto" => $_POST["nome_prodotto"],
            "giacenza" => $_POST["giacenza"],
            "prezzo" => $_POST["prezzo"]
        ]);

        return redirect("/read");
    }

    public function delete()
    {
        DB::table('prodotti')->where("id", $_POST["id"])->delete();

        return redirect("/read");
    }
}
