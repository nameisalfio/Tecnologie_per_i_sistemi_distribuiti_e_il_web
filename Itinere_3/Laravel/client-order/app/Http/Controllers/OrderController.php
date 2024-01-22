<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Client;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view("orders.index", ["orders" => Order::all()]);
    }

    public function create()
    {
        return view("orders.create", ["clients" => Client::all()]);
    }

    public function store(Request $request)
    {
        Order::create($request->all());
        return redirect()->route("orders.index");
    }

    public function show(Order $order)
    {
        return view("orders.show", ["o" => $order]);
    }

    public function edit(Order $order)
    {
        return view("orders.edit", ["o" => $order,"clients" => Client::all()]);
    }

    public function update(Request $request, Order $order)
    {
        $order->update($request->all());
        return redirect()->route("orders.index");
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route("orders.index");
    }
}
