<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model
{
    protected $table      = 'siswa';
    protected $primaryKey = 'id_siswa';

    protected $allowedFields = [
        'nama_lengkap',
        'nama_panggilan',
        'tanggal_lahir',
        'gender',
        'agama',
        'anak_ke',
        'alamat',
        'kewarganegaraan'
    ];

    protected $useTimestamps = false;
}
