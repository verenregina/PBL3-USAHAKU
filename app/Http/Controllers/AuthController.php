<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // TAMPILKAN LOGIN
    public function showLogin()
    {
        return view('auth.login');
    }

    // PROSES LOGIN
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        if (Auth::attempt($data)) {
            $request->session()->regenerate();
            if (Auth::user()->role == 'admin') {
                return redirect('/admin'); // admin
            } else {
                return redirect('/'); // user
            }
        }
    
        return back()->withErrors([
            'email' => 'Email atau password salah'
        ]);
    }

    // TAMPILKAN REGISTER
    public function showRegister()
    {
        return view('auth.register');
    }

    // PROSES REGISTER
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);
    
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user'
        ]);
    
        return redirect('/login')->with('success', 'Register berhasil');
    }

    // LOGOUT
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}