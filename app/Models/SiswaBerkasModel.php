<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaBerkasModel extends Model
{
    protected $table      = 'siswa_berkas';
    protected $primaryKey = 'id_berkas';

    protected $allowedFields = [
        'id_siswa',
        'jenis_berkas',
        'file_path',
        'uploaded_at'
    ];

    protected $useTimestamps = false;
}
