<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{

    public function index()
    {
        return response()->json(Product::all());
    }

    public function indexview()
    {
        $product = Product::with('category')->get();
        $productResource = ProductResource::collection($product);

        return view('products.index', [
            'products' => $productResource
        ]);
    }

    public function show($id)
    {
        $product = Product::find($id);
        if (!$product)
            return response()->json(['error' => 'NotFound'], 404);
        return response()->json($product);
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        $product = Product::create($validated);

        return response()->json($product, 201);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product)
            return response()->json(['error' => 'Not found'], 404);

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'sometimes|required|numeric|min:0',
        ]);

        $product->update($validated);

        return response()->json($product);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product)
            return response()->json(['error' => 'Not found'], 404);

        $product->delete();

        return response()->json(['message' => 'Deleted']);
    }



}
