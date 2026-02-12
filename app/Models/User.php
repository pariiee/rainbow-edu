<?php

namespace App\Models;

use App\Models\Siswa;
use App\Models\SiswaQuestionnaire;
use App\Models\Jadwal;
use App\Models\Chat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * Mass assignable attributes
     */
    protected $fillable = [
        'name',
        'email',
        'password',

        // Role domain
        'role_type',
        'guru_type',
        'nama_anak',

        // OTP
        'otp',
        'otp_plain',
        'otp_expiry',
        'otp_attempt',
        'otp_cooldown',

        // Password reset (custom)
        'reset_token',
        'reset_token_expiry',
        'reset_attempt',

        // Verification
        'is_verified',
        'verified_at',
        'last_login',
    ];

    /**
     * Hidden attributes
     */
    protected $hidden = [
        'password',
        'remember_token',
        'otp',
        'reset_token',
    ];

    /**
     * Attribute casting
     */
    protected function casts(): array
    {
        return [
            'email_verified_at'   => 'datetime',
            'verified_at'         => 'datetime',
            'last_login'          => 'datetime',
            'otp_expiry'          => 'datetime',
            'otp_cooldown'        => 'datetime',
            'reset_token_expiry'  => 'datetime',
            'is_verified'         => 'boolean',
            'password'            => 'hashed',
        ];
    }

    /* =====================================================
     | QUERY SCOPES
     ===================================================== */

    public function scopeOrangTua($query)
    {
        return $query->where('role_type', 'orang_tua');
    }

    public function scopeGuru($query)
    {
        return $query->where('role_type', 'guru');
    }

    public function scopeGuruPaud($query)
    {
        return $query->where('guru_type', 'PAUD');
    }

    public function scopeGuruLearn($query)
    {
        return $query->where('guru_type', 'Learn kursus');
    }

    public function scopeGuruHomelearning($query)
    {
        return $query->where('guru_type', 'Homelearning kursus private');
    }

    /* =====================================================
     | RELATIONS
     ===================================================== */

    // Orang tua memiliki banyak siswa
    public function siswaList()
    {
        return $this->hasMany(Siswa::class, 'orang_tua_id');
    }

    // Guru memiliki banyak siswa yang ditugaskan
    public function assignedSiswa()
    {
        return $this->hasMany(Siswa::class, 'guru_id');
    }

    // Submission questionnaire
    public function questionnaires()
    {
        return $this->hasMany(SiswaQuestionnaire::class, 'user_id');
    }

    // ==========================
    // JADWAL
    // ==========================

    public function jadwalGuru()
    {
        return $this->hasMany(Jadwal::class, 'guru_id');
    }

    public function jadwalOrtu()
    {
        return $this->hasMany(Jadwal::class, 'orang_tua_id');
    }

    // ==========================
    // CHAT
    // ==========================

    public function chatDikirim()
    {
        return $this->hasMany(Chat::class, 'pengirim_id');
    }

    public function chatDiterima()
    {
        return $this->hasMany(Chat::class, 'penerima_id');
    }

    public function unreadMessages()
    {
        return $this->chatDiterima()->where('is_read', false);
    }

    /* =====================================================
     | OTP LOGIC
     ===================================================== */

    public function canRequestOtp(): bool
    {
        if (!$this->otp_cooldown) {
            return true;
        }

        return Carbon::now()->gt($this->otp_cooldown);
    }

    public function updateOtp(array $data): bool
    {
        return $this->update($data);
    }

    public function verifyOtp(string $otp): bool
    {
        if (!$this->otp || !$this->otp_expiry) {
            return false;
        }

        if (Carbon::now()->gt($this->otp_expiry)) {
            return false;
        }

        if (Hash::check($otp, $this->otp)) {
            $this->update([
                'is_verified' => true,
                'verified_at' => now(),
                'otp' => null,
                'otp_plain' => null,
                'otp_expiry' => null,
                'otp_attempt' => 0,
            ]);

            return true;
        }

        $this->increment('otp_attempt');
        return false;
    }

    /* =====================================================
     | PASSWORD RESET (CUSTOM)
     ===================================================== */

    public function canRequestPasswordReset(): bool
    {
        if ($this->reset_attempt < 3) {
            return true;
        }

        return $this->updated_at->lt(now()->subMinutes(15));
    }

    public function createPasswordResetToken(): string
    {
        $token = bin2hex(random_bytes(32));

        $this->update([
            'reset_token' => Hash::make($token),
            'reset_token_expiry' => now()->addHour(),
            'reset_attempt' => 0,
        ]);

        return $token;
    }

    public function verifyResetToken(string $token): bool
    {
        if (!$this->reset_token || !$this->reset_token_expiry) {
            return false;
        }

        if (now()->gt($this->reset_token_expiry)) {
            return false;
        }

        return Hash::check($token, $this->reset_token);
    }

    public function resetPassword(string $token, string $newPassword): bool
    {
        if (!$this->verifyResetToken($token)) {
            return false;
        }

        return $this->update([
            'password' => Hash::make($newPassword),
            'reset_token' => null,
            'reset_token_expiry' => null,
            'reset_attempt' => 0,
        ]);
    }

    public function incrementResetAttempt(): void
    {
        $this->increment('reset_attempt');
        $this->touch();
    }

    /* =====================================================
     | MAINTENANCE
     ===================================================== */

    public static function cleanupUnverifiedUsers(): int
    {
        return self::where('is_verified', false)
            ->where('created_at', '<', now()->subMinutes(15))
            ->delete();
    }
}
