<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Jadwal extends Model
{
    protected $table = 'jadwals';
    
    protected $fillable = [
        'guru_id',
        'siswa_id',
        'orang_tua_id',
        'tanggal',
        'waktu',
        'durasi',
        'catatan',
        'status',
        'feedback_ortu',
        'feedback_guru',
        'is_pengajuan_pengganti',
        'tanggal_pengganti',
        'waktu_pengganti',
        'alasan_pengganti'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'waktu' => 'datetime',
        'tanggal_pengganti' => 'date',
        'waktu_pengganti' => 'datetime',
        'is_pengajuan_pengganti' => 'boolean',
    ];

    public function guru(): BelongsTo
    {
        return $this->belongsTo(User::class, 'guru_id');
    }

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class);
    }

    public function orangTua(): BelongsTo
    {
        return $this->belongsTo(User::class, 'orang_tua_id');
    }
}