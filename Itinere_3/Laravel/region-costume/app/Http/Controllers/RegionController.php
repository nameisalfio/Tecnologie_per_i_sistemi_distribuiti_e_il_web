<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function index()
    {
        return view("regions.index", ["regions" => Region::all()]);
    }

    public function create()
    {
        return view("regions.create");
    }

    public function store(Request $request)
    {
        Region::create($request->all());
        return redirect()->route("regions.index");
    }

    public function show(Region $region)
    {
        return view("regions.show", ["r" => $region]);
    }

    public function edit(Region $region)
    {
        return view("regions.edit", ["r" => $region]);
    }

    public function update(Request $request, Region $region)
    {
        $region->update($request->all());
        return redirect()->route("regions.index");
    }

    public function destroy(Region $region)
    {
        $region->delete();
        return redirect()->route("regions.index");
    }
}
