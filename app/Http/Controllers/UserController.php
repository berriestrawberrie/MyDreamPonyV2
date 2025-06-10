<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function register(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'birthday' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'birthday' => $request->birthday,
            'email' => $request->email,
            'password' => Hash::make($request->password),

        ]);
        return redirect('/')->with('success', 'Registration successful! Please log in.');
    }

    public function login(Request $request)
    {
        $credientials = $request->only('name', 'password');
        if (Auth::attempt($credientials)) {
            $user = Auth::user();

            return view('home', compact('user'));
        }
        return redirect('/')->with('error', 'Invalid credentials. Please try again.');
    }

    public function logout(Request $request)
    {

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
