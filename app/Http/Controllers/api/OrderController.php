<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
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

        if ($orders->isEmpty()) {
            return response()->json(['message' => 'No orders found.'], 204);
        }

        return response()->json([
            'message' => 'Orders retrieved successfully.',
            'data' => $orders,
        ], 200);
    }

    /**
     * Create an order for a specific client.
     */
    public function create(Client $client)
    {
        $categories = Category::with('products')->get();
        $orders = $client->orders()->with('products')->paginate(5);

        return response()->json([
            'message' => 'Order creation page data retrieved.',
            'data' => [
                'client' => $client,
                'categories' => $categories,
                'orders' => $orders,
            ],
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Client $client)
    {
        $request->validate([
            'products' => 'required|array',
        ]);

        $order = $this->attach_order($request, $client);

        return response()->json([
            'message' => 'Order added successfully.',
            'data' => $order,
        ], 201);
    }

    /**
     * Edit an existing order for a client.
     */
    public function edit(Client $client, Order $order)
    {
        $categories = Category::with('products')->get();

        return response()->json([
            'message' => 'Order edit page data retrieved.',
            'data' => [
                'client' => $client,
                'order' => $order,
                'categories' => $categories,
            ],
        ], 200);
    }

    /**
     * Update an existing order.
     */
    public function update(Request $request, Client $client, Order $order)
    {
        $request->validate([
            'products' => 'required|array',
        ]);

        $this->detach_order($order);
        $updatedOrder = $this->attach_order($request, $client);

        return response()->json([
            'message' => 'Order updated successfully.',
            'data' => $updatedOrder,
        ], 200);
    }

    /**
     * Remove the specified order from storage.
     */
    public function destroy(Client $client, Order $order)
    {
        $this->detach_order($order);

        return response()->json([
            'message' => 'Order deleted successfully.',
        ], 200);
    }

    /**
     * Attach products to an order and calculate total price.
     */
    private function attach_order($request, $client)
    {
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

        return $order->refresh();
    }

    /**
     * Detach products from an order and restore stock.
     */
    private function detach_order($order)
    {
        foreach ($order->products as $product) {
            $product->update(['stock' => $product->stock + $product->pivot->quantity]);
        }

        $order->delete();
    }
}
