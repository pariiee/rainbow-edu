<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $fillable = [
        'nama_lengkap',
        'nama_panggilan',
        'tempat_lahir',
        'tanggal_lahir',
        'gender',
        'agama',
        'bahasa_sehari_hari',
        'alamat_domisili',
        'status_pendaftaran',
        'asal_cabang',
        'layanan',
    ];

    public function profile()
    {
        return $this->hasOne(SiswaProfile::class);
    }
}
