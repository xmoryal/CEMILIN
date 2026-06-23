<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kantin;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KantinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'kantin';
        
        //memulai query
        $query = Kantin::query();

        //jika ada input search maka menampilkan data :
        if($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search){
                $q->where('nama_kantin', 'LIKE', "%{$search}%") //cari berdasarkan nama kantin
                ->orWhere('email', 'LIKE', "%{$search}%"); //cari berdasarkan email
            }); 
        }
        //membuat sistem paginasi
        //meminta sistem mengurutkan data terbaru ke terlama berdasarkan query
        $kantin = $query->orderBy('created_at', 'desc')->paginate(10);

        //memastikan agar pagination tetap membawa data saat pindah halaman
        $kantin->appends($request->only('search'));

        return view('Admin.kantin.index', compact('title', 'kantin'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'kantin tambah';
        return view('Admin.kantin.add', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kantin' => 'required|min:3',
            'email' => 'required|email|unique:kantin,email',
            'password' => 'required|min:5'
        ]);
        //hash password
        $validated['password'] = Hash::make($validated['password']);

        //memasukan data
        Kantin::create($validated);

        //mengarah ke halaman kantin
        return redirect()->route('admin.kantin.index')->with('success', 'Kantin berhasil ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //cari id siswa
        $siswa = Kantin::findOrFail($id);

        //memulai proses hapus
        $siswa->delete();


        return redirect()->route('admin.kantin.index')->with('success', 'Kantin berhasil dihapus');
    }
}
