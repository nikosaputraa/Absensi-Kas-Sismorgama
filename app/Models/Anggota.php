<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    public $table = "tb_siswa";
    protected $primaryKey = 'id_siswa';

    protected $fillable = [
        'id_siswa',
        'nis',
        'nama_siswa',
        'id_kelas',
        'jenis_kelamin',
        'no_hp',
        'unique_code',
    ];
}
