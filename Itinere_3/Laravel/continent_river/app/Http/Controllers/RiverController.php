<?php

namespace App\Http\Controllers;

use App\Models\River;
use App\Models\Continent;
use Illuminate\Http\Request;

class RiverController extends Controller
{
    public function index()
    {
        return view("rivers.index", ["rivers"=>River::all()]);
    }

    public function create()
    {
        return view("rivers.create", ["continents"=>Continent::all()]);
    }

    public function store(Request $request)
    {
        River::create($request->all());
        return redirect()->route("rivers.index");
    }

    public function show(river $river)
    {
        return view("rivers.show", ["r" => $river]);
    }

    public function edit(river $river)
    {
        return view("rivers.edit", ["r" => $river, "continents"=>Continent::all()]);
    }

    public function update(Request $request, river $river)
    {
        $river->update($request->all());
        return redirect()->route("rivers.index");
    }

    public function destroy(river $river)
    {
        $river->delete();
        return redirect()->route("rivers.index");
    }

    public function filter()
    {
        $filtered = River::where('length', '>=', 4000)->get();
        return view("rivers.filtered", ["rivers" => $filtered]);
    }

    public function unfilter()
    {
        return view("rivers.index", ["rivers" => River::all()]);
    }
}
