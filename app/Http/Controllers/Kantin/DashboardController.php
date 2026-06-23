<?php

namespace App\Http\Controllers\Kantin;

use App\Http\Controllers\Controller;
use App\Models\Kantin;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $title = 'dashboard';
        $penjualId = Auth::guard('kantin')->user()->id;
        $totalProduk = Produk::where('penjual_id', $penjualId)->count();

        return view('Penjual.index', compact('title', 'totalProduk'));
    }
}
