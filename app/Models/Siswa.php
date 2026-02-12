<?php

namespace App\Models;

use App\Models\User;
use App\Models\Jadwal;
use App\Models\Chat;
use App\Models\SiswaProfile;
use App\Models\SiswaQuestionnaire;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Siswa extends Model
{
    protected $table = 'siswa';
    
    protected $fillable = [
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'gender',
        'agama',
        'bahasa_sehari_hari',
        'alamat_domisili',
        'status_pendaftaran',
        'asal_cabang',
        'layanan',
        'guru_id',
        'orang_tua_id',
        'status_assign',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    /* =====================================================
     | RELATIONS
     ===================================================== */

    public function profile(): HasOne
    {
        return $this->hasOne(SiswaProfile::class);
    }

    public function questionnaire(): HasOne
    {
        return $this->hasOne(SiswaQuestionnaire::class);
    }

    public function guru(): BelongsTo
    {
        return $this->belongsTo(User::class, 'guru_id');
    }

    public function orangTua(): BelongsTo
    {
        return $this->belongsTo(User::class, 'orang_tua_id');
    }

    // ==========================
    // JADWAL
    // ==========================

    public function jadwals(): HasMany
    {
        return $this->hasMany(Jadwal::class);
    }

    // ==========================
    // CHAT
    // ==========================

    public function chats(): HasMany
    {
        return $this->hasMany(Chat::class);
    }
}
