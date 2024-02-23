<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sesi extends Model
{
    public $table = "tb_sesi";
    protected $primaryKey = 'id_sesi';

    protected $fillable = [
        'id_sesi',
        'nama_kegiatan',
        'tanggal',
        'judul',
    ];
}
