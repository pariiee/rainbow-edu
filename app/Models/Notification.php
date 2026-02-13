<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Notification extends Model
{
    protected $table = 'notifications';
    
    protected $fillable = [
        'judul',
        'isi',
        'target',
        'target_ids',
        'created_by',
        'scheduled_at',
        'sent_at',
        'status'
    ];

    protected $casts = [
        'target_ids' => 'array',
        'scheduled_at' => 'datetime',
        'sent_at' => 'datetime'
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function userNotifications(): HasMany
    {
        return $this->hasMany(UserNotification::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_notifications')
                    ->withPivot('is_read', 'read_at')
                    ->withTimestamps();
    }
}