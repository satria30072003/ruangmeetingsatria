<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // 🟦 Tampilkan halaman login
    public function showLogin()
    {
        return view('auth.login');
    }

    // ✅ Proses login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Regenerasi session untuk keamanan
            $request->session()->regenerate();

            // Redirect ke halaman yang sesuai berdasarkan role
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect('/reservasi'); // Ganti dengan route yang sesuai untuk user biasa
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah',
        ]);
    }

    // 🟩 Tampilkan halaman register
    public function showRegister()
    {
        return view('auth.register');
    }

    // 🔐 Proses register
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan login.');
    }

    // 🚪 Proses logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
    public function create()
    {
        return view('auth.login'); // Pastikan file resources/views/auth/login.blade.php ada
    }



    public function redirectUser()
    {

        dd(Auth::user()->role); // Debugging line to check the role
        if (Auth::check()) {

            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect('/home');
            }
        }

        return redirect('/login');
    }
    public function authenticated(Request $request, $user)
{
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('dashboard');
}

}