<?php

namespace App\Http\Controllers;

use App\Models\Continent;
use Illuminate\Http\Request;

class ContinentController extends Controller
{
    public function index()
    {
        return view("continents.index", ["continents"=>Continent::all()]);
    }

    public function create()
    {
        return view("continents.create");
    }

    public function store(Request $request)
    {
        Continent::create($request->all());
        return redirect()->route("continents.index");
    }

    public function show(Continent $continent)
    {
        return view("continents.show", ["c" => $continent]);
    }

    public function edit(Continent $continent)
    {
        return view("continents.edit", ["c" => $continent]);
    }

    public function update(Request $request, Continent $continent)
    {
        $continent->update($request->all());
        return redirect()->route("continents.index");
    }

    public function destroy(Continent $continent)
    {
        $continent->delete();
        return redirect()->route("continents.index");
    }
}
