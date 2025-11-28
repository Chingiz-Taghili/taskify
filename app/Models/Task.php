<?php

namespace App\Models;

use AjCastro\EagerLoadPivotRelations\EagerLoadPivotTrait;
use App\Enums\TaskStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Staudenmeir\EloquentHasManyDeep\HasOneDeep;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Task extends Model
{
    use HasFactory, SoftDeletes, EagerLoadPivotTrait, HasRelationships;

    protected $fillable = [
        'client_id', 'project_id', 'category_id', 'title',
        'description', 'status', 'parent_task_id', 'due_date',
    ];

    protected $appends = ['client'];

    protected function casts(): array
    {
        return ['status' => TaskStatus::class, 'due_date' => 'datetime'];
    }

    protected function client(): Attribute
    {
        return Attribute::get(function () {
            if ($this->relationLoaded('clientDirect') && $this->clientDirect) {
                return $this->clientDirect;
            }
            return $this->relationLoaded('clientViaProject') ? $this->clientViaProject : null;
        });
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'task_user')->using(
            TaskUser::class)->withPivot(['assigned_by', 'assigned_at'])->as('assignment');
    }

    public function clientDirect(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function clientViaProject(): HasOneDeep
    {
        return $this->hasOneDeepFromRelations($this->project(), (new Project())->client());
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
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

    protected static function booted(): void
    {
        static::creating(function ($task) {
            $task->status ??= TaskStatus::TODO->value;
        });
    }
}
