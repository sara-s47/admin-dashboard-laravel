<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class MainOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $orders = Order::wherehas('client' , function($q) use($request){
            return $q->where('name' , 'like' , '%' , $request->search , '%');
        })->get();

        return view('dashboard.orders.index' , compact('orders'));

    }

    public function products(Order $order){

        $products = $order->products()->get();
        return response()->json(['html' => view('dashboard.orders._products', compact('products', 'order'))->render()]);



    }

    
    public function create()
    {
        //
    }

 
    public function store(Request $request)
    {
        //
    }

  
    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(Order $order)
    {
        // dd($order);
        foreach($order->products as $product){
            $product->update(['stock' => $product->stock + $product->pivot->quantity]);
        }
        $order->delete();
        session()->flash('success' , 'oreder deleted successfully');
        return redirect()->route('dashboard.orders.index');
    }
}
