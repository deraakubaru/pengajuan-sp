<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class SemesterPendek extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'dosen_wali_id',
        'mahasiswa_id',
        'matakuliah_id',
        'level',
        'keterangan',
    ];

    public function matakuliah()
    {
        return $this->belongsTo(Matakuliah::class, 'matakuliah_id');
    }

    public function dosen()
    {
        return $this->belongsTo(User::class, 'dosen_wali_id', 'nimp');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'mahasiswa_id', 'nimp');
    }
}
