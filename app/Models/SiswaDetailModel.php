<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaDetailModel extends Model
{
    protected $table      = 'siswa_detail';
    protected $primaryKey = 'id_detail';

    protected $allowedFields = [
        'id_siswa',
        'nama_ayah',
        'nama_ibu',
        'alamat_ortu_wali',
        'pekerjaan_ayah',
        'kantor_ayah',
        'nohp_ayah',
        'pekerjaan_ibu',
        'kantor_ibu',
        'nohp_ibu',
        'bahasa',
        'jumlah_saudara_kandung',
        'nama_saudara_kandung',
        'usia_saudara_kandung',
        'sumber_informasi',
        'consent_konten'
    ];

    protected $useTimestamps = false;
}
