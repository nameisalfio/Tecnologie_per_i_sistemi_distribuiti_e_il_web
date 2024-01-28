<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\Costume;
use Illuminate\Http\Request;

class CostumeController extends Controller
{
    public function index()
    {
        return view("costumes.index", ["costumes" => Costume::all()]);
    }

    public function create()
    {
        return view("costumes.create", ["regions" => Region::all()]);
    }

    public function store(Request $request)
    {
        Costume::create($request->all());
        return redirect()->route("costumes.index");
    }

    public function show(costume $costume)
    {
        return view("costumes.show", ["c" => $costume]);
    }

    public function edit(costume $costume)
    {
        return view("costumes.edit", ["c" => $costume, "regions" => Region::all()]);
    }

    public function update(Request $request, costume $costume)
    {
        $costume->update($request->all());
        return redirect()->route("costumes.index");
    }

    public function destroy(costume $costume)
    {
        $costume->delete();
        return redirect()->route("costumes.index");
    }

    public function Arlecchino()
    {
        $costumes = Costume::all();
        foreach($costumes as $c) 
        {
            $c->price /= 2; 
            $c->save();
        }  
        return redirect()->route("costumes.index");
    }
    
    public function Pulcinella()
    {
        $costumes = Costume::all();
        foreach($costumes as $c) 
        {
            $c->price *= 2; 
            $c->save();
        }  
        return redirect()->route("costumes.index");
    }
}
