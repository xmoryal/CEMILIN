<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kantin;
use App\Models\Produk;
use App\Models\Siswa;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function  index()
    {
        $title = 'beranda';
        $kantin = Kantin::count();
        $siswa = Siswa::count();
        $produk = Produk::count();
        return view('Admin.index', compact('title', 'siswa', 'kantin', 'produk'));
    }
}
