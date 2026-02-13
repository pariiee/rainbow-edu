<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaBerkas extends Model
{
    use HasFactory;

    protected $table = 'siswa_berkas';
    protected $primaryKey = 'id_berkas';

    public $timestamps = false; // karena pakai uploaded_at manual

    protected $fillable = [
        'id_siswa',
        'nama_berkas',
        'file_path',
        'keterangan',
        'uploaded_at',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }
}
