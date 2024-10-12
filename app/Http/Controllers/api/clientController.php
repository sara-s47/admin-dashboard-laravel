<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class clientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::all();

        $data = [
            "message" => "all clients",
            "data" => $clients
        ];

        if($clients->isEmpty()){
            return response()->json($data , 204);
        }

        return response()->json($data , 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $request_data = $request->except('password_confirmation');

        Client::create($request_data);

        $data = [
            "message" => "created successfully",
            "data" => $request_data
        ];

        return response()->json($data , 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        return response()->json([
            "message" => "Client details",
            "data" => $client
        ], 200);
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'password' => 'nullable|min:8|confirmed',
        ]);
    
        $request_data = $request->except('password_confirmation');
    
        $client->update($request_data);
    
        return response()->json([
            "message" => "Client updated successfully",
            "data" => $client
        ], 200);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();
    
        return response()->json([
            "message" => "Client deleted successfully"
        ], 200);
    }
}
