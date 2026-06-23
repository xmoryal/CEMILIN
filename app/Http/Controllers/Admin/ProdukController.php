<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $title = 'produk';

        $query = Produk::query();

        if($request->filled('search')) {
            $search = $request->search;
            $query->where( function($q) use ($search){
                $q->where('nama_produk', 'LIKE', "%{$search}%")
                ->orWhere('harga', 'LIKE', "%{$search}%")
                ->orWhere('stok', 'LIKE', "%{$search}%");
            });
        }

        $produk = $query->orderBy('created_at', 'desc')->paginate(10);

        $produk->appends($request->only('search'));
        
        return view('Admin.produk.list', compact('title', 'produk'));
    }
}
