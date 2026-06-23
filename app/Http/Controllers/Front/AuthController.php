<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function index()
    {
        return view('Siswa.Auth');
    }

    function login(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if(Auth::guard('siswa')->attempt($validated)) {
            $request->session()->regenerate();
            
            return redirect()->intended(route('siswa.beranda'));
        }

        return back()->withErrors([
            'username' => 'Username atau password salah',
            'password' => 'Username atau password salah',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('siswa.login');
    }
}
