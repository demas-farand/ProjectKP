<?php

namespace App\Models\absensi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $table = 'absensi';

    protected $fillable = [
        'id_guru',
        'mata_pelajaran',
        'lokasi',
        'jam_masuk',
        'jam_keluar',
        'keterangan'
    ];

    public function Guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru');
    }
}
