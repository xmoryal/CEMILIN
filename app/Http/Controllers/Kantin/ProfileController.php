<?php

namespace App\Http\Controllers\Kantin;

use App\Http\Controllers\Controller;
use App\Models\Kantin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Nette\Utils\Image;

class ProfileController extends Controller
{
    public function edit()
    {
        $penjualId = Auth::guard('kantin')->User()->id;
        $penjual = Kantin::findOrFail($penjualId);
        return view('Penjual.profile.edit', compact('penjual'));
    }

    public function update(Request $request, string $id)
    {
        $penjual = Kantin::findOrFail($id);

        $validated = $request->validate([
            'foto' => 'nullable|image|mimes:png,jpg,jpeg',
            'nama_kantin' => 'required|min:3|unique:kantin,nama_kantin,' . $id,
            'password' => 'nullable|min:5|confirmed',
            'nama_bank' => 'required',
            'no_rekening' => 'required',
            'deskripsi' => 'nullable'
        ]);

        //hash password jika diisi
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            // Jika password kosong, hapus dari array agar tidak update password
            unset($validated['password']);
        }

        //jika user menginput foto yang baru maka buat kode foto yg baru, dan masukan folder
        if($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = uniqid() . '.webp';
            $path = 'assets/img/profile/';
            
            //mengubah ukuran dan format gambar
            $manager = new ImageManager(new Driver());

            $manager->read($file) //mencari gambar
            ->cover(400, 600) //mengubah ukuran gambar menjadi 400x600px
            ->toWebp(75) //mengubah format gambar menjadi webp 75%
            ->save(public_path($path . $filename)); //menyimpan gambar pada 'assets/img/profile/' . uniqid() . '.webp' atau contoh = assets/img/profile/17368238.webp 

            //hapus file lama
            if($penjual->foto && file_exists(public_path($path . '/' . $penjual->foto))) {
                @unlink(public_path($path . '/' . $penjual->foto));
            }
            //set nama foto baru
            $validated['foto'] = $filename;
        } else {
                // kalau tidak ada file baru, jangan override kolom foto:
                // hapus key 'foto' dari $validated jika ada (agar tidak null-kan kolom)
                
                unset($validated['foto']);
            
        }

        $penjual->update($validated);

        return redirect()->route('penjual.dashboard')->with('success', 'Profile berhasil diedit');
    }

}
