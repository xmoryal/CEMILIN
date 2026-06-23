<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Kantin;
use App\Models\Kategori;
use App\Models\Keranjang;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BerandaController extends Controller
{
    function index(Request $request)
    {
        $title = 'beranda';
        $kategori = Kategori::all();
        $kantin = Kantin::all();
        $siswaId = Auth::guard('siswa')->User()->id;
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
        
        return view('Siswa.beranda', compact('title', 'produk', 'kategori', 'keranjang', 'total', 'hitungproduk', 'kantin'));   
    }

    public function produkKategori($id, Request $request) 
    {
        $kategori = Kategori::all();
        $kantin = Kantin::all();
        $siswaId = Auth::guard('siswa')->User()->id;
        $query = Produk::where('kategori_id', $id);

        if($request->filled('search')) {
            $search = $request->search;
            $query->where( function($q) use ($search){
                $q->where('nama_produk', 'LIKE', "%{$search}%")
                ->orWhere('harga', 'LIKE', "%{$search}%")   
                ->orWhere('stok', 'LIKE', "%{$search}%");
            });
        }
        $produk = $query->orderBy('created_at', 'desc')->paginate(15);
        $produk->appends($request->only('search'));

        $kategoriId = Kategori::find($id);
        $namaKategori = $kategoriId->kategori;

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

        return view('Siswa.kategori', compact('kategori', 'produk', 'namaKategori', 'keranjang', 'total', 'hitungproduk', 'kantin'), ['title' => 'produk kategori' . $namaKategori]);
    }

    function kantin(Request $request, $id)
    {
        $kategori = Kategori::all();
        $kantin = Kantin::all();
        $siswaId = Auth::guard('siswa')->User()->id;
        $query = Produk::where('penjual_id', $id);

        if($request->filled('search')) {
            $search = $request->search;
            $query->where( function($q) use ($search){
                $q->where('nama_produk', 'LIKE', "%{$search}%")
                ->orWhere('harga', 'LIKE', "%{$search}%")   
                ->orWhere('stok', 'LIKE', "%{$search}%");
            });
        }
        $produk = $query->orderBy('created_at', 'desc')->paginate(15);
        $produk->appends($request->only('search'));

        $kantinId = Kantin::find($id);
        $namaKantin = $kantinId->nama_kantin;

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

        return view('Siswa.kantin', compact('kategori', 'produk', 'namaKantin', 'keranjang', 'total', 'hitungproduk', 'kantin'), ['title' => 'produk kantin' . $namaKantin]);
    }
}
