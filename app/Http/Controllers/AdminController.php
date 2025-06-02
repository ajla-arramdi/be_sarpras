<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            return redirect()->intended('admin/dashboard');
        }

        return back()->withErrors(['email' => 'Email atau Password salah']);
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }

    // // Tambahkan method dashboard
    // public function dashboard()
    // {
    //     // Jika kamu punya data dari model bisa di-passing ke view dashboard di sini.
    //     return view('admin.dashboard'); // Pastikan file view admin/dashboard.blade.php ada
    // }
}
