<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiswaProfile extends Model
{
    protected $fillable = [
        'gaya_belajar',
        'minat_khusus',
        'temperamen',
        'trigger_emosi',
        'strategi_menenangkan',
        'nama_ayah',
        'pekerjaan_ayah',
        'alamat_kantor_ayah',
        'nohp_ayah',
        'nama_ibu',
        'pekerjaan_ibu',
        'alamat_kantor_ibu',
        'nohp_ibu',
        'decision_maker',
        'saudara_kandung',
        'harapan_ortu',
        'riwayat_alergi',
        'kondisi_khusus',
        'kontak_darurat',
        'sumber_informasi',
        'consent_konten',
    ];

    // ✅ PINDAHKAN KE DALAM CLASS
    protected $casts = [
        'minat_khusus' => 'array',
        'trigger_emosi' => 'array',
        'strategi_menenangkan' => 'array',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
