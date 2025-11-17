<?php

namespace App\Models;

use App\Enums\TaskStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'client_id', 'project_id', 'category_id',
        'title', 'description', 'status', 'parent_task_id', 'due_date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function assignedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(TaskAttachment::class)->orderBy('sort_order');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Task::class, 'parent_task_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Task::class, 'parent_task_id');
    }

    protected function casts(): array
    {
        return ['status' => TaskStatus::class];
    }

    protected static function booted(): void
    {
        static::creating(function ($task) {
            $task->assigned_by = $task->assigned_by ?? auth()->id();
            $task->assigned_at = now();
            $task->status = $task->status ?? TaskStatus::TODO->value;
        });
    }
}
