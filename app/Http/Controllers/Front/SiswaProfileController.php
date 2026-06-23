<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class SiswaProfileController extends Controller
{
    public function edit()
    {
        $siswaId = Auth::guard('siswa')->User()->id;
        $siswa = Siswa::findOrFail($siswaId);
        return view('Siswa.profile', compact('siswa'));
    }

    public function update(Request $request, string $id)
    {
        $siswa = Siswa::findOrFail($id);

        $validated = $request->validate([
            'foto' => 'nullable|image|mimes:png,jpg,jpeg',
            'username' => 'sometimes|nullable|unique:siswa,username,' . $id,
            'password' => 'nullable|min:5',
        ]);

        //hash password jika diisi
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            // Jika password kosong, hapus dari array agar tidak update password
            unset($validated['password']);
        }

        //jika user menginput foto yang baru maka buat kode foto yg baru dengan mengubahnya menjadi .webp, dan masukan folder img
        if($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = uniqid() . '.webp';
            $path = 'assets/img/profile/';

            //ubah ukuran gambar ke 400x600 pixel
            $manager = new ImageManager(new Driver());

            $manager->read($file)
            ->cover(400, 600) //mengubah ukuran gambar menjadi 400x600 px
            ->toWebp(75) //mengubah format gambar menjadi .webp
            ->save(public_path($path . $filename)); //simpan gambar pada folder img

            //hapus file lama
            if($siswa->foto && file_exists(public_path($path . $siswa->foto))) {
                @unlink(public_path($path . $siswa->foto));
            }
            //set nama foto baru
            $validated['foto'] = $filename;
        } else {
                // kalau tidak ada file baru, jangan override kolom foto:
                // hapus key 'foto' dari $validated jika ada (agar tidak null-kan kolom)
                unset($validated['foto']);
            
        }

        $siswa->update($validated);

        return redirect()->route('siswa.beranda')->with('success', 'Profile berhasil diedit');
    }
}
