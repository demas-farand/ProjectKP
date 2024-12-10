<?php

namespace App\Models\absensi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable =
        [
            'name',
            'email',
            'phone_number',
            'subject'
        ];
}
