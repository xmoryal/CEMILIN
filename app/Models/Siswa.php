<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Siswa extends Authenticatable
{
    use Notifiable;
    protected $table = 'siswa';
    protected $fillable = ['foto', 'nama', 'kelas', 'username', 'password'];
    protected $hidden = ['password'];
}
