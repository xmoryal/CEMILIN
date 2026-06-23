<?php

namespace App\Http\Controllers\Kantin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'produk';

        //mengambil id penjual
        $penjualId = Auth::guard('kantin')->User()->id;

        $query = Produk::query()->where('penjual_id', $penjualId);

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
        
        return view('Penjual.produk.list', compact('title', 'produk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'tambah produk';
        $kategori = Kategori::all();
        return view('Penjual.produk.add', compact('title', 'kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_id' => 'required',
            'foto' => 'required|image|mimes:png,jpg,jpeg',
            'nama_produk' => 'required|min:2',
            'harga' => 'required|integer',
            'deskripsi' => 'required|min:10',
            'stok' => 'required|min:1'
        ]);

        //ambil file foto
        $file = $request->file('foto');

        //buat nama uniq dengan ekstensi asli
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();

        //folder tujuan
        $path = 'assets/img/produk';

        //pindah file foto ke folder publik
        $file->move(public_path($path), $filename);

        //tambah nama file foto yg disimpan
        $validated['foto'] = $filename;

        //simpan id penjual dari user yang login
        $validated['penjual_id'] = Auth::guard('kantin')->User()->id;

        //menyimpan data baru ke database
        Produk::create($validated);

        return redirect()->route('penjual.produk.index')->with('success', 'produk berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'edit produk';
        $produk = Produk::findOrFail($id);
        $kategori = Kategori::all();
        return view('Penjual.produk.edit', compact('title', 'produk', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $produk = Produk::findOrFail($id);

        $validated = $request->validate([
            'kategori_id' => 'required',
            'foto' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'nama_produk' => 'required|min:2',
            'harga' => 'required|integer',
            'deskripsi' => 'required|min:10',
            'stok' => 'required|integer|min:0'
        ]);

        //jika user menginput foto yang baru maka buat kode foto yg baru, dan masukan folder
        if($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $path = 'assets/img/produk/';
            $file->move(public_path($path), $filename); //assets/img/produk/17628632.png

            //hapus file lama
            if($produk->foto && file_exists(public_path($path . '/' . $produk->foto))) {
                @unlink(public_path($path . '/' . $produk->foto));
            }
            //set nama foto baru
            $validated['foto'] = $filename;
        } else {
                // kalau tidak ada file baru, jangan override kolom foto:
                // hapus key 'foto' dari $validated jika ada (agar tidak null-kan kolom)
                if (array_key_exists('foto', $validated)) {
                unset($validated['foto']);
            }
        }

        $produk->update($validated);
        return redirect()->route('penjual.produk.index')->with('success', 'produk berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $produk = Produk::findOrFail($id);
        
        // Folder tempat foto disimpan
        $path = 'assets/img/produk';

        // Hapus foto dari folder kalau ada
        if ($produk->foto && file_exists(public_path($path . '/' . $produk->foto))) {
        @unlink(public_path($path . '/' . $produk->foto));
        }

        $produk->delete();
        return redirect()->route('penjual.produk.index')->with('success', 'produk berhasil dihapus');
    }
}
