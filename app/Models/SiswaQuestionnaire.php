<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SiswaQuestionnaire extends Model
{
    protected $table = 'siswa_questionnaires';

    protected $fillable = [
        'siswa_id',
        'user_id',
        'sekolah_sebelumnya',
        'usia_anak',
        'tujuan_pendaftaran',
        'tingkat_kemandirian',
        'ekspektasi_ortu',
        'minat_bakat',
        'catatan_kesehatan',
        'is_skipped',
        'skipped_at',
        'completed_at',
    ];

    protected $casts = [
        'is_skipped' => 'boolean',
        'skipped_at' => 'datetime',
        'completed_at' => 'datetime',
        'usia_anak' => 'integer',
    ];

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}