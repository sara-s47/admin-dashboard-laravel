<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Storage;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:users_read'])->only('index');
        $this->middleware(['permission:users_create'])->only('create');
        $this->middleware(['permission:users_update'])->only('update');
        $this->middleware(['permission:users_delete'])->only('destroy');
    }
    public function index(Request $request)
    {
        $users = User::whereRoleIs('admin')->where(function ($q) use ($request) {

            return $q->when($request->search, function ($query) use ($request) {

                return $query->where('first_name', 'like', '%' . $request->search . '%')
                    ->orWhere('last_name', 'like', '%' . $request->search . '%');

            });
        })->latest()->paginate(5);
        return view('dashboard.users.index', ['users' => $users]);
    }

    public function create()
    {
        return view('dashboard.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'image' => 'image',
            'password' => 'required|confirmed',

        ]);

        $request_data = $request->except(['password', 'password_confirmation', 'permissions', 'image']);
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

        session()->flash('success', ('added successfuly'));
        return redirect()->route('dashboard.users.index');
    }

    public function edit(User $user)
    {
        return view('dashboard.users.edit', compact('user'));

    }

    // public function update(Request $request , User $user){

    //     $request->validate([
    //         'first_name' => 'required',
    //         'last_name' => 'required',
    //         'email' => 'required',
    //         'image' => 'image'

    //     ]);

    //     $request_data = $request->except(['permissions']);

    //     if ($request->hasFile('image')) {

    //         $image = $request->file('image'); 

    //         $imageName = $image->getClientOriginalName();

    //         $destinationPath = public_path('uploads/user_images/');

    //         $image->move($destinationPath, $imageName); 

    //         $request_data['image'] = $imageName ;

    //         if ($user->image) {

    //             $oldImagePath = public_path('uploads/user_images/' . $user->image);

    //             if (file_exists($oldImagePath)) {

    //                 unlink($oldImagePath); 
    //             }
    //         }


    //     }else{
    //         $request_data['image']= $user->image ?? 'default.png';
    //      }

    //     $user->update($request_data);
    //     $user->syncPermissions($request->permissions);

    //     session()->flash('success', __('updated successfully'));
    //     return redirect()->route('dashboard.users.index');    }




    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email', // Added email validation
            'image' => 'image|nullable' // Make the image nullable
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

        session()->flash('success', __('updated successfully'));
        return redirect()->route('dashboard.users.index');
    }

    public function destroy(User $user)
    {
        if ($user->image != 'default.png') {

            Storage::disk('public_uploads')->delete('/user_images/' . $user->image);

        }//end of if

        $user->delete();
        session()->flash('success', __('deleted successfully'));
        return redirect()->route('dashboard.users.index');

    }
}
