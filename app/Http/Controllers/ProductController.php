<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Storage;

class ProductController extends Controller
{

    public function index(Request $request)
    {

        $categories = Category::all();
        $categories_count= Category::count();

        $products = Product::when($request->search , function($q) use($request){

            return $q->where('name', 'LIKE', '%' . $request->search . '%');

        })->when($request->category_id , function($q)use ($request){

            return $q->where('category_id' , $request->category_id);
        })->latest()->paginate(5);
        return view('dashboard.products.index', compact('products' , 'categories' , 'categories_count'));
    }


    public function create()
    {
        $categories = Category::all();
        return view('dashboard.products.create', compact('categories'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:products,name',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'purchase_price' => 'required|string',
            'sale_price' => 'required|string',
            'image' => 'required|required',
            'stock' => 'required|string'
        ]);

        $request_data = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image'); // Get the file immediately
            $imageName = $image->getClientOriginalName(); // Create a unique name for the image
            $destinationPath = public_path('uploads/products_images');
            $image->move($destinationPath, $imageName); // Move the image to the destination path
            $request_data['image'] =  "uploads/products_images/" .$imageName ; // Save the image name in the request data
        }

        Product::create($request_data);
        session()->flash('success' , ('added successfuly'));
        return redirect()->route('dashboard.products.index' );
    }


    public function show(Product $product)
    {
        //
    }


    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('dashboard.products.edit', compact('categories', 'product'));
    }


    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string',
            'category_id' => 'required',
            'description' => 'required|string',
            'purchase_price' => 'required|string',
            'sale_price' => 'required|string',
            'image' => 'required|image',
            'stock' => 'required|string'
        ]);

        $request_data = $request->all();

        if ($request->hasFile('image')) {

            $image = $request->file('image'); 

            $imageName = $image->getClientOriginalName();
            
            $destinationPath = public_path('uploads/products_images');

            $image->move($destinationPath, $imageName); 

            $request_data['image'] =  "uploads/products_images/" .$imageName ;

            if ($product->image) {

                $oldImagePath = public_path('uploads/products_images/' . $product->image);

                if (file_exists($oldImagePath)) {

                    unlink($oldImagePath); 
                }
            }

        
        }

        $product->update($request_data);
        session()->flash('success' , ('updated successfuly'));
        return redirect()->route('dashboard.products.index');
    }


    public function destroy(Product $product)
    {
        $product->delete();
        Storage::disk('public_uploads')->delete('/product_images/' . $product->image);
        session()->flash('success' , 'deleted sucessfully');
        return redirect()->route('dashboard.products.index');
    }
}
