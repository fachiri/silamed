<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('pages.auth.login');
    }

    public function auth_login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()
                ->route('dashboard.index')
                ->withSuccess('Selamat datang');
        }

        return redirect()
            ->back()
            ->withErrors(['message' => 'Ups! Username atau password salah']);
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();

        return redirect()
            ->route('login');
    }
}