<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $orders = Order::whereHas('client', function ($q) use ($request) {

            return $q->where('name', 'like', '%' . $request->search . '%');

        })->paginate(5);

        return view('dashboard.orders.index', compact('orders'));
    }

 
    public function create(Client $client)
    {
        
        $categories = Category::with('products')->get();
        $orders = $client->orders()->with('products')->paginate(5);
        return view('dashboard.clients.orders.create', compact('client', 'categories' , 'orders'));
    }


    public function store(Request $request, Client $client)
    {
        $request->validate([

            'products' => 'required|array',
        ]);

        $this->attach_order($request , $client);
        
        session()->flash('success' , 'added successfully');

        return redirect()->route('dashboard.orders.index');
        
    }

    public function edit(Client $client, Order $order)
    {
        $categories = Category::with('products')->get();
        return view('dashboard.clients.orders.edit' , compact('client', 'order' , 'categories' ));
    }


    public function update(Request $request, Client $client, Order $order)
    {
        $request->validate([

            'products' => 'required|array',

        ]);

        // dd($client);

        $this->detach_order($order);
        $this->attach_order($request , $client);

        session()->flash('success' , 'updated successfully');

        return redirect()->route('dashboard.orders.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client, Order $order)
    {
        //
    }

    private function attach_order( $request , $client ){
        $order = $client->orders()->create([
            'client_id' => $client->id,
        ]);


        $total_price = 0;

        foreach ($request->products as $id => $productData) {
            $product = Product::findOrFail($id);
            $quantity = $productData['quantity'];
    
            // Attach product with quantity to the pivot table
            $order->products()->attach($id, ['quantity' => $quantity]);
    
            // Update total price
            $total_price += $product->sale_price * $quantity;
    
            // Update stock
            $product->update(['stock' => $product->stock - $quantity]);
        }
        
        $order->update(['total_price' => $total_price]);

        $order->refresh();


    }

    private function detach_order($order){
        
        foreach($order->products as $product){
            $product->update(['stock' => $product->stock + $product->pivot->quantity]);
        }
        $order->delete();
    }
}
