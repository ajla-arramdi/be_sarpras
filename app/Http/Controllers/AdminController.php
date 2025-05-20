<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin/auth.login');
    }

    // Proses Login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('admin/dashboard');
        }

        return back()->withErrors(['email' => 'Email atau Password salah']);
    }

    public function dashboard()
{
    return view('admin.dashboard');
}

public function logout()
{
    Auth::logout();
    return redirect()->route('login');
}

}
