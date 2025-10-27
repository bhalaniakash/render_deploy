<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class auth extends Controller
{
    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Registration logic goes here
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        // If validation fails, Laravel will automatically redirect back with errors.
        // At this point, $validatedData contains the validated input and is truthy,
        // so don't attempt to treat it as an error condition.
        // Create the user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);
        
        // Redirect to a desired location
        // Prefer redirect after POST (Post/Redirect/Get). If you don't have a named
        // 'home' route, redirect to the site root instead.
        return redirect('/');
    }

    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $velidatedData = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (auth()->attempt($velidatedData)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');

        
    }
}
