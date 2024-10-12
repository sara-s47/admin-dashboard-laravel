<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class MainOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $orders = Order::whereHas('client', function ($q) use ($request) {
            return $q->where('name', 'like', '%' . $request->search . '%');
        })->get();

        if ($orders->isEmpty()) {
            return response()->json(['message' => 'No orders found.'], 204);
        }

        return response()->json([
            'message' => 'Orders retrieved successfully.',
            'data' => $orders,
        ], 200);
    }


    /**
     * Store a newly created resource in storage.
     */

    /**
     * Display the specified resource.
     */    public function show(Order $order)
    {
        $products = $order->products()->get();

        if ($products->isEmpty()) {
            return response()->json(['message' => 'No products found for this order.'], 204);
        }

        return response()->json([
            'message' => 'Products retrieved successfully.',
            'data' => $products,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        // Loop through the order's products and update stock
        foreach ($order->products as $product) {
            $product->update(['stock' => $product->stock + $product->pivot->quantity]);
        }

        $order->delete();

        return response()->json([
            'message' => 'Order deleted successfully.',
        ], 200);
    }
}
