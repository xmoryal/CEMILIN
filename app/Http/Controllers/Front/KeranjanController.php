<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeranjanController extends Controller
{
    public function addToCart(Request $request) 
    {
        $produkId = $request->id;

        //jika ada record
        if (Keranjang::where('produk_id', $produkId)->where('siswa_id', Auth::guard('siswa')->User()->id)->exists()) {
            //tambah 1 quantity
            Keranjang::where('produk_id', $produkId)->where('siswa_id', Auth::guard('siswa')->User()->id)->increment('banyak', 1);
        } else {
            // jika tidak ada maka insert
            $keranjang = new Keranjang;

            $keranjang->siswa_id = Auth::guard('siswa')->user()->id;
            $keranjang->produk_id = $produkId;

            $keranjang->save();
        }

        return response()->json([
            'info' => 'product berhasil ditambahkan'
        ]);
    }

}
