<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
        /**
         * Display a listing of the resource.
         */
        public function index(Request $request)
        {
            $categories = Category::when($request->search, function ($q) use ($request) {
                return $q->where('name', 'like', '%' . $request->search . '%');
            })->latest()->get();
    
            if ($categories->isEmpty()) {
                return response()->json([
                    'message' => 'No categories found.',
                ], 204);
            }
    
            return response()->json([
                'message' => 'Categories retrieved successfully.',
                'data' => $categories,
            ], 200);
        }
    
        /**
         * Store a newly created resource in storage.
         */
        public function store(Request $request)
        {
            $request->validate([
                'name' => 'required|unique:categories,name',
            ]);
    
            $category = Category::create($request->all());
    
            return response()->json([
                'message' => 'Category created successfully.',
                'data' => $category,
            ], 201);
        }
    
        /**
         * Display the specified resource.
         */
        public function show(Category $category)
        {
            return response()->json([
                'message' => 'Category retrieved successfully.',
                'data' => $category,
            ], 200);
        }
    
        /**
         * Update the specified resource in storage.
         */
        public function update(Request $request, Category $category)
        {
            $request->validate([
                'name' => 'required|unique:categories,name,' . $category->id,
            ]);
    
            $category->update($request->all());
    
            return response()->json([
                'message' => 'Category updated successfully.',
                'data' => $category,
            ], 200);
        }
    
        /**
         * Remove the specified resource from storage.
         */
        public function destroy(Category $category)
        {
            $category->delete();
    
            return response()->json([
                'message' => 'Category deleted successfully.',
            ], 200);
        }
    }

