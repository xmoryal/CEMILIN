<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Kantin extends Authenticatable
{
    use Notifiable;
    protected $table = 'kantin';
    protected $fillable = ['foto', 'nama_kantin', 'email', 'password', 'nama_bank', 'no_rekening', 'deskripsi'];
    protected $hidden = ['password'];
}
