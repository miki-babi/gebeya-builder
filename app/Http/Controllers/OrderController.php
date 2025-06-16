<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order; // Assuming you have an Order model

class OrderController extends Controller
{
    //
    public function place(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'product_id' => 'required|integer',
            'amount' => 'required|integer|min:1',
            'phone' => 'required|string|max:15',
        ]);
        // dd($data);
        // Here you would typically create an order in the database
        // For example:
        Order::create($data);

        return response()->json(['message' => 'Order placed successfully!'], 201);

    }
    public function index()
    {
        // Assuming you have an Order model
        $orders = Order::all();
        return view('orders.index', compact('orders'));
    }
    public function show($id)
    {
        // Assuming you have an Order model
        $order = Order::findOrFail($id);
        return view('orders.show', compact('order'));
    }
    public function edit($id)
    {
        // Assuming you have an Order model
        $order = Order::findOrFail($id);
        return view('orders.edit', compact('order'));
    }
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'status' => 'required|in:pending,completed,canceled',
        ]);

        // Assuming you have an Order model
        $order = Order::findOrFail($id);
        $order->update($data);

        return response()->json(['message' => 'Order updated successfully!'], 200);
    }
    public function destroy($id)
    {
        // Assuming you have an Order model
        $order = Order::findOrFail($id);
        $order->delete();

        return response()->json(['message' => 'Order deleted successfully!'], 200);
    }

}
