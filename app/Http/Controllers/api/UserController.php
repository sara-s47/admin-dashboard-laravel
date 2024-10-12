<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
     public function index(Request $request)
    {
        $users = User::whereRoleIs('admin')->where(function ($q) use ($request) {
            return $q->when($request->search, function ($query) use ($request) {
                return $query->where('first_name', 'like', '%' . $request->search . '%')
                    ->orWhere('last_name', 'like', '%' . $request->search . '%');
            });
        })->latest()->paginate(5);

        return response()->json($users);
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'image' => 'image|nullable',
            'password' => 'required|confirmed',
        ]);

        $request_data = $request->except(['password', 'password_confirmation', 'permissions']);
        $request_data['password'] = bcrypt($request->password);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/user_images'), $imageName);
            $request_data['image'] = $imageName;
        }

        $user = User::create($request_data);
        $user->attachRole('admin');
        $user->syncPermissions($request->permissions);

        return response()->json(['message' => 'User created successfully', 'user' => $user], 201);
    }

    public function show(User $user)
    {
        return response()->json($user);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'image' => 'image|nullable'
        ]);

        $request_data = $request->except(['permissions']);

        // Check if an image file was uploaded
        if ($request->hasFile('image')) {
            // Get the uploaded image
            $image = $request->file('image');
            // Generate a new name for the image
            $imageName = time() . '_' . $image->getClientOriginalName(); // Avoid duplicate file names
            $destinationPath = public_path('uploads/user_images/');
            // Move the image to the desired location
            $image->move($destinationPath, $imageName);

            // If the user has an existing image, delete it
            if ($user->image && $user->image !== 'default.png') {
                $oldImagePath = public_path('uploads/user_images/' . $user->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Set the new image name in request_data
            $request_data['image'] = $imageName;
        } else {
            // If no image was uploaded, retain the existing image or set the default
            $request_data['image'] = $user->image ?? 'default.png';
        }

        // Update the user data with the new image data
        $user->update($request_data);
        $user->syncPermissions($request->permissions);

        return response()->json(['message' => 'User updated successfully', 'user' => $user]);
    }

    public function destroy(User $user)
    {
        if ($user->image && $user->image !== 'default.png') {
            Storage::disk('public_uploads')->delete('/user_images/' . $user->image);
        }

        $user->delete();
        return response()->json(['message' => 'User deleted successfully']);
    }
}
