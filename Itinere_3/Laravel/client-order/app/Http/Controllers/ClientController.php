<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        return view("clients.index", ["clients" => Client::all()]);
    }

    public function create()
    {
        return view("clients.create");
    }

    public function store(Request $request)
    {
        Client::create($request->all());
        return redirect()->route("clients.index");
    }

    public function show(Client $client)
    {
        return view("clients.show", ["c" => $client]);
    }

    public function edit(Client $client)
    {
        return view("clients.edit", ["c" => $client]);
    }

    public function update(Request $request, Client $client)
    {
        $client->update($request->all());
        return redirect()->route("clients.index");
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route("clients.index");
    }
}
