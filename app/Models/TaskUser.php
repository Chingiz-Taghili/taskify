<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TaskUser extends Pivot
{
    use HasFactory;

    protected $table = 'task_user';

    protected $fillable = ['task_id', 'user_id',];

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function assignedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }

    protected function casts(): array
    {
        return ['assigned_at' => 'datetime'];
    }

    protected static function booted(): void
    {
        static::creating(function (TaskUser $pivot) {
            $pivot->assigned_by ??= auth()->id();
            $pivot->assigned_at = now();
        });
    }
}
