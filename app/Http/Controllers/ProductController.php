<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => ['required', 'string'],
            'product_price' => ['required', 'numeric'],
            'product_type' => ['required', 'numeric'],
            'product_description' => ['required'],
            'image' => ['required'],
        ]);

        $slug = Str::slug($request['product_name'], '-');

        $data = [
            'title' => $request['product_name'],
            'slug' => $slug,
            'price' => $request['product_price'],
            'description' => $request['product_description'],
            'type' => $request['product_type'],
        ];

        if ($request->has('image')) {

            $file = $request->image;

            $destinationPath = 'storage/images/products/';

            $imagePath = $destinationPath . date('YmdHis') . "." . $file->getClientOriginalExtension();

            $file->move($destinationPath, $imagePath);

            // store image url to data image
            $data['image'] = $imagePath;
        }

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Product create successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'product_name' => ['required', 'string'],
            'product_price' => ['required', 'numeric'],
            'product_type' => ['required', 'numeric'],
            'image' => ['nullable', 'file', 'image'],
        ]);

        $slug = Str::slug($request['product_name'], '-');

        $data = [
            'title' => $request['product_name'],
            'slug' => $slug,
            'price' => $request['product_price'],
            'type' => $request['product_type'],
        ];

        if ($request->has('image')) {
            // Store the uploaded image in the public folder
            $imagePath = $request->file('image')->store('uploads', 'public');

            // store image url to data image
            $data['image'] = 'storage/' . $imagePath;
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Product edited successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}
