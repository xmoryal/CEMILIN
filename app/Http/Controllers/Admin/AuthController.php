<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function index() 
    {
        return view('Admin.Auth.login');
    }

    //proses login
    function login(Request $request)
    {
        //membuat ketentuan validasi
        $credential = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //mencoba login ke halaman admin
        if(Auth::attempt($credential)) {
            //membuat token untuk admin
            $request->session()->regenerate();

            //mengarah ke halaman admin
            return redirect()->intended(route('admin.beranda'))->with('success', 'login berhasil');
        }

        if(Auth::guard('kantin')->attempt($credential)) {
            $request->session()->regenerate();

            return redirect()->route('penjual.dashboard');
        }

        // jika gagal
        return back()->withErrors([
            'email' => 'email atau password salah',
            'password' => 'email atau password salah'
        ])->onlyInput('email');
    }

    //proses logout
    function logout(Request $request)
    {
        //menghapus total sesi yg telah digunakan
        $request->session()->invalidate();
        //membuat ulang sesi token
        $request->session()->regenerateToken();
        //mengarah ke halaman login
        return redirect()->route('admin.login');
    }
}
