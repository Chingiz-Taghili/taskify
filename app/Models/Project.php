<?php

namespace App\Models;

use App\Enums\ProjectStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Staudenmeir\EloquentHasManyDeep\HasManyDeep;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Project extends Model
{
    use HasFactory, SoftDeletes, HasRelationships;

    protected $fillable = ['name', 'client_id', 'description', 'cover_photo', 'status',];

    protected function casts(): array
    {
        return ['status' => ProjectStatus::class];
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function users(): HasManyDeep
    {
        return $this->hasManyDeepFromRelations(
            $this->tasks(), (new Task())->users())->distinct();
    }

    protected static function booted(): void
    {
        static::creating(function ($project) {
            $project->status ??= ProjectStatus::PLANNED->value;
        });
    }
}
