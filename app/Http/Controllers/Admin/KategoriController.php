<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KategoriController extends Controller
{
    function list(Request $request)
    {
        $title = 'kategori';

        //mulai query
        $query = Kategori::query();

        //jika ada input search maka menampilkan data yang dicari
        if($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search){
              $q->where('kategori', 'LIKE', "%{$search}%");  
            }); 
        }
        //mengurut data berdasarkan terbaru
        $kategori = $query->orderBy('created_at', 'desc')->paginate(10);

        //memastikan agar hasil tidak pindah
        $kategori->appends($request->only('search'));

        return view('Admin.kategori.list', compact('title', 'kategori'));
    }

    function add()
    {
        $title = 'tambah kategori';
        return view('Admin.kategori.add', compact('title'));
    }

    function addPost(Request $request)
    {
        $validated = $request->validate([
            'kategori' => 'required|unique:kategori,kategori'
        ]);
        Kategori::create($validated);

        return redirect()->route('admin.kategori.list')->with('success', 'kategori berhasil ditambahkan');
    }

    function edit(string $id)
    {
        $title = 'edit kategori';
        $kategori = Kategori::findOrFail($id);

        return view('Admin.kategori.edit', compact('title', 'kategori'));
    }

    function editPost(Request $request, string $id)
    {
        $kategori = Kategori::findOrFail($id);

        $validated = $request->validate([
            'kategori' => 'required|unique:kategori,kategori'
        ]);

        $kategori->update($validated);

        return redirect()->route('admin.kategori.list')->with('success', 'kategori berhasil diedit');
    }

    function delete(Request $request, string $id)
    {
        $kategori = Kategori::findOrFail($id);

        $kategori->delete();

        return redirect()->route('admin.kategori.list')->with('success', 'kategori berhasil dihapus');
    }
}
