<?php

namespace App\Models\absensi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendance';

    protected $fillable = [
        'teacher_id',
        'date',
        'check_in_time',
        'check_out_time',
        'status',
        'remarks',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
