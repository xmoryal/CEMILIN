<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\select;

class CekoutController extends Controller
{
    public function produk(string $id)
    {
        $produk = Produk::select('produk.*', 'kategori.kategori', 'kantin.nama_kantin')
        ->join('kategori', 'produk.kategori_id', '=', 'kategori.id')
        ->join('kantin', 'produk.penjual_id', 'kantin.id')
        ->findOrFail($id);
    
        $siswaId = Auth::guard('siswa')->User()->id;
        $siswa = Siswa::findOrFail($siswaId);
        $total = $produk->harga + 200;

        $kode = 'CML' . '-' . $siswaId . $produk->penjual_id . $produk->id . $produk->kategori_id;

        return view('Siswa.cekout', compact('produk', 'siswa', 'total', 'kode'));
    }

    public function produkKeranjang()
    {

    }
}
