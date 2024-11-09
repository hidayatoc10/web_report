<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login_ui()
    {
        return view("auth.login");
    }
    public function login_be(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'min:3', 'max:50', 'email'],
            'password' => ['required', 'min:8', 'max:50'],
        ]);

        if (Auth::attempt($data)) {
            $request->session()->regenerate();
            if (auth()->user()->keterangan === 'Admin') {
                return redirect()->route('dashboard_admin');
            } else if (auth()->user()->keterangan === 'Guru') {
                return redirect()->route('dashboard_guru');
            } else if (auth()->user()->keterangan === 'Wali Murid') {
                return redirect()->route('dashboard_wali_murid');
            }
        }
        return redirect()->route('login')->with('gagal', 'Gagal Login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login')->with('berhasil_logout', 'berhasil');
    }
    public function logout_guru(Request $request)
    {
        Auth::logout();
        return redirect()->route('login')->with('berhasil_logout', 'berhasil');
    }
    public function logout_walimurid(Request $request)
    {
        Auth::logout();
        return redirect()->route('login')->with('berhasil_logout', 'berhasil');
    }
}