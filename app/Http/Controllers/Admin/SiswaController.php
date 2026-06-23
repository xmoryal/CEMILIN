<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    /**
     * halaman utama siswa
     */
    public function index(Request $request)
    {
        $title = 'siswa';

        //mulai quey
        $query = Siswa::query();

        //jika ada input search, maka cari berdasarkan :
        if($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search){
                $q->where('nama', 'LIKE', "%{$search}%") // cari berdasarkan nama
                ->orWhere('kelas', 'LIKE', "%{$search}%") //cari berdasarkan kelas
                ->orWhere('username', 'LIKE', "%{$search}%"); //cari berdasarkan username
            });
        }
        //ambil 10 data siswa menggunakan pagination
        //meminta sistem mengurutkan data dari paling atas ke bawah berdasarkan data terbaru
        $siswa = $query->orderBy('created_at', 'desc')->paginate(10);

        //memastikan pagination tetap membawa query string search saat pindah halaman
        $siswa->appends($request->only('search'));

        return view('Admin.siswa.index', compact('title', 'siswa'));
    }

    /**
     * mengarah ke halaman tambah
     */
    public function create()
    {
        $title = 'tambah siswa';
        return view('Admin.siswa.add', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //membuat validasi
        $validated = $request->validate([
            'nama' => 'required',
            'kelas' => 'required',
            'username' => 'required|unique:siswa,username',
            'password' => 'required|min:5',
        ]);
        //membuat hash password
        $validated['password'] = Hash::make($validated['password']);

        //meminta kepada model untuk membuat data baru
        Siswa::create($validated);

        //mengarah ke halaman siswa
        return redirect()->route('admin.siswa.index')->with('success', 'data berhasil ditambahkan');
    }

    /**
     * mengarah ke halaman edit
     */
    public function edit(string $id)
    {
        $title = 'edit siswa';
        $siswa = Siswa::findOrFail($id);
        return view('Admin.siswa.edit', compact('title', 'siswa'));
    }

    /**
     * proses edit
     */
    public function update(Request $request, string $id)
    {
        //mencari siswa berdasarkan id
        $siswa = Siswa::findOrFail($id);

        //membuat validasi
        $validated = $request->validate([
            'nama' => 'required',
            'kelas' => 'required',
        ]);

        $siswa->update($validated);

        return redirect()->route('admin.siswa.index')->with('success', 'data berhasil di edit');
    }

    /**
     * proses hapus
     */
    public function destroy(string $id)
    {
        //cari id siswa
        $siswa = Siswa::findOrFail($id);

        //memulai proses hapus
        $siswa->delete();

        return redirect()->route('admin.siswa.index')->with('success', 'Data berhasil dihapus');
    }
}
