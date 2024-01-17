<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function read()
    {
        return view('read', ['products' => Product::all()]);
    }

    public function create(Request $request)
    {
        Product::create($request->all());
        return redirect('/read');
    }

    public function form(Request $request)
    {
        $product = Product::find($request->input('id'));

        if ($request->input("action") === "Modifica")
            return view('update', ['product' => $product]);

        if ($request->input("action") === "Rimuovi")
            $product->delete();

        return redirect('/read');
    }

    public function update(Request $request)
    {
        $product = Product::find($request->input('id'));
        $product->update($request->all()); // Simile alla create
        return redirect('/read');
    }
}
