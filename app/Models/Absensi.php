<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $table = 'tb_presensi';
    protected $fillable = [
        'id',
        'nim',
        'nama_mahasiswa',
        'divisi',
        'id_sesi',
        'waktu_absen',
    ];
}
