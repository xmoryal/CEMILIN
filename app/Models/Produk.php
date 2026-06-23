<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    protected $fillable = ['penjual_id' ,'kategori_id', 'foto', 'nama_produk', 'harga', 'deskripsi', 'stok'];


    //mamastikan relasi antar id
    public function penjual()
    {
        return $this->belongsTo(Kantin::class, 'penjual_id');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}
