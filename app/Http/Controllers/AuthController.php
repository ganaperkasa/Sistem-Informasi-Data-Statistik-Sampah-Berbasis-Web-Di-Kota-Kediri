<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login.login'); // HTML login kamu simpan di resources/views/auth/login.blade.php
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['email' => 'Email atau password salah']);
        }

        if ($user->role !== 'admin') {
            return back()->withErrors(['email' => 'Akses hanya untuk admin']);
        }

        Auth::login($user);
        return redirect()->intended('/dashboard'); // Ganti sesuai halaman utama admin
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}

