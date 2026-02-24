<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $fillable = [
        'nama_lengkap', 'nik', 'email', 'no_telepon', 'jabatan',
        'departemen', 'tanggal_masuk', 'status', 'alamat',
        'tanggal_lahir', 'jenis_kelamin', 'pendidikan_terakhir',
        'foto', 'cv', 'created_by',
    ];

    protected $casts = [
        'tanggal_masuk' => 'date',
        'tanggal_lahir' => 'date',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}