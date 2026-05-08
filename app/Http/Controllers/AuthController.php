<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Nampilin Form Login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Proses Login
    public function prosesLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect sesuai role
            if (Auth::user()->role === 'pustakawan') {
                return redirect()->intended('/pustakawan/dashboard')->with('success', 'Selamat datang Pustakawan!');
            }

            return redirect()->intended('/anggota/dashboard')->with('success', 'Berhasil login sebagai Anggota!');
        }

        return back()->with('error', 'Email atau Password salah!');
    }

    // Nampilin Form Register Anggota
    public function showRegister()
    {
        return view('auth.register');
    }

    // Proses Register Anggota
    public function prosesRegister(Request $request)
    {
        $request->validate([
            'nis' => 'required|unique:users',
            'name' => 'required',
            'kelas' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        User::create([
            'nis' => $request->nis,
            'name' => $request->name,
            'kelas' => $request->kelas,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'anggota' // Otomatis jadi anggota
        ]);

        return redirect('/login')->with('success', 'Akun berhasil dibuat! Silahkan login.');
    }

    // Proses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Berhasil logout!');
    }
}
