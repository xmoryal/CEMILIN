<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Kantin;
use App\Models\Kategori;
use App\Models\Keranjang;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DetailProdukController extends Controller
{
    function index(string $id)
    {
        $title = 'Detail Produk';
        $kategori = Kategori::all();
        $kantin = Kantin::all();
        $siswaId = Auth::guard('siswa')->User()->id;

        /**keranjang */
        $total = 0;
        $hitungproduk = Keranjang::where('siswa_id', $siswaId)->count();

            $keranjang = Keranjang::select('keranjang.*', 'produk.nama_produk', 'produk.foto', 'produk.harga')
                ->join('produk', 'keranjang.produk_id', '=', 'produk.id')
                ->where('siswa_id', Auth::guard('siswa')->user()->id)
                ->get();

            if (!$keranjang->isEmpty()) {
                $total = $keranjang->sum(function($item) {
                    return $item->harga * $item->banyak;
                });
            }

        /**produk */
        $produk = Produk::select('produk.*', 'kategori.kategori', 'kantin.nama_kantin')
        ->join('kategori', 'produk.kategori_id', '=', 'kategori.id')
        ->join('kantin', 'produk.penjual_id', '=', 'kantin.id')
        ->findOrFail($id);

        return view('Siswa.detailproduk', compact('title', 'kategori', 'kantin', 'hitungproduk', 'total', 'keranjang', 'produk'));
    }
}
