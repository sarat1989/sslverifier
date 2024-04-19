<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(2);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {

	// Validate form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);


        // Create user

	$user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
	$user->save();


        return redirect()->route('users.index')->with('success', 'User created successfully.');


    }

public function destroy($id)
    {
        // Find the user by ID
        $user = User::find($id);

        // Check if the user exists
        if (!$user) {
            // Return a response if user not found
            return redirect()->back()->with('error', 'User not found.');
        }

        // Delete the user
        $user->delete();

        // Redirect to a success page or route
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }    


}


