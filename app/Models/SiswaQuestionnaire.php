<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SiswaQuestionnaire extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'siswa_questionnaires';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'siswa_id',
        'user_id',
        'sekolah_sebelumnya',
        'usia_anak',
        'tujuan_pendaftaran',
        'tingkat_kemandirian',
        'ekspektasi_ortu',
        'is_skipped',
        'skipped_at',
        'completed_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_skipped' => 'boolean',
        'skipped_at' => 'datetime',
        'completed_at' => 'datetime',
        'usia_anak' => 'integer',
    ];

    /**
     * Get the siswa that owns the questionnaire.
     */
    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class);
    }

    /**
     * Get the user that owns the questionnaire.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}