<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Assuming you have a Product model

class ProductController extends Controller
{
    //
    public function create(){
        return view('products.create');
    }
    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image_url' => 'nullable|array',
            'category' => 'nullable|array',
            'is_available' => 'boolean',
            'stock_quantity' => 'integer|min:0',
        ]);

        // Assuming you have a Product model
        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }
    public function index(){
        // Assuming you have a Product model
        $products = Product::all();
        return view('products.index', compact('products'));
    }
    public function show($id){
        // Assuming you have a Product model
        $product = Product::findOrFail($id);
        // dd($product);
        return view('products.show', compact('product'));
    }
    public function edit($id){
        // Assuming you have a Product model
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }
    public function update(Request $request, $id){
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image_url' => 'nullable|array',
            'category' => 'nullable|array',
            'is_available' => 'boolean',
            'stock_quantity' => 'integer|min:0',
        ]);

        // Assuming you have a Product model
        $product = Product::findOrFail($id);
        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }
    public function destroy($id){
        // Assuming you have a Product model
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        // Assuming you have a Product model
        $products = Product::search($searchTerm)->get();
        return view('products.search', compact('products'));
    }
}
