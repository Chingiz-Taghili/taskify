<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class TaskAttachment extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = ['task_id', 'file_path', 'order_index',];

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['task_id', 'file_path', 'order_index'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->useLogName('task_attachment')
            ->setDescriptionForEvent(fn(string $event) => "Attachment for Task #{$this->task_id} {$event}");
    }
}
