<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        $categories_count = Category::count();

        $products = Product::when($request->search, function($q) use($request) {
            return $q->where('name', 'LIKE', '%' . $request->search . '%');
        })->when($request->category_id, function($q) use ($request) {
            return $q->where('category_id', $request->category_id);
        })->latest()->paginate(5);

        if ($products->isEmpty()) {
            return response()->json(['message' => 'No products found.'], 204);
        }

        return response()->json([
            'message' => 'Products retrieved successfully.',
            'data' => [
                'products' => $products,
                'categories' => $categories,
                'categories_count' => $categories_count,
            ],
        ], 200);
    }

    /**
     * Store a newly created product.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:products,name',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'purchase_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'image' => 'required|image',
            'stock' => 'required|numeric',
        ]);

        $request_data = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/products_images'), $imageName);
            $request_data['image'] = "uploads/products_images/" . $imageName;
        }

        $product = Product::create($request_data);

        return response()->json([
            'message' => 'Product added successfully.',
            'data' => $product,
        ], 201);
    }

    /**
     * Show the specified product.
     */
    public function show(Product $product)
    {
        return response()->json([
            'message' => 'Product retrieved successfully.',
            'data' => $product,
        ], 200);
    }

    /**
     * Update the specified product.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|unique:products,name,' . $product->id,
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'purchase_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'image' => 'sometimes|image',
            'stock' => 'required|numeric',
        ]);

        $request_data = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/products_images'), $imageName);
            $request_data['image'] = "uploads/products_images/" . $imageName;

            // Delete the old image if it exists
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }
        }

        $product->update($request_data);

        return response()->json([
            'message' => 'Product updated successfully.',
            'data' => $product,
        ], 200);
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }

        $product->delete();

        return response()->json([
            'message' => 'Product deleted successfully.',
        ], 200);
    }
}
