<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Staudenmeir\EloquentHasManyDeep\HasManyDeep;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Client extends Model
{
    use HasFactory, SoftDeletes, HasRelationships;

    protected $fillable = ['name', 'logo', 'notes',];

    protected $appends = ['tasks', 'users'];

    protected function tasks(): Attribute
    {
        return Attribute::get(function () {
            $tasks = collect();
            if ($this->relationLoaded('tasksDirect')) {
                $tasks = $tasks->merge($this->tasksDirect);
            }
            if ($this->relationLoaded('tasksViaProject')) {
                $tasks = $tasks->merge($this->tasksViaProject);
            }
            return $tasks->unique('id');
        });
    }

    protected function users(): Attribute
    {
        return Attribute::get(function () {
            $users = collect();
            if ($this->relationLoaded('usersViaTask')) {
                $users = $users->merge($this->usersViaTask);
            }
            if ($this->relationLoaded('usersViaProject')) {
                $users = $users->merge($this->usersViaProject);
            }
            return $users->unique('id');
        });
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function tasksDirect(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function tasksViaProject(): HasManyThrough
    {
        return $this->hasManyThrough(Task::class, Project::class)->distinct();
    }

    public function usersViaTask(): HasManyDeep
    {
        return $this->hasManyDeepFromRelations(
            $this->tasksDirect(), (new Task())->users())->distinct();
    }

    public function usersViaProject(): HasManyDeep
    {
        return $this->hasManyDeepFromRelations($this->projects(),
            (new Project())->tasks(), (new Task())->users())->distinct();
    }
}
