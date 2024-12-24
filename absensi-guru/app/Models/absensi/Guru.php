<?php

namespace App\Models\absensi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'guru';
    protected $fillable =
        [
            'username',
            'passowrd',
            'nama',
            'email',
            'no_telp',
            'mata_pelajaran'
        ];
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }
}
