<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use AjCastro\EagerLoadPivotRelations\EagerLoadPivotTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Staudenmeir\EloquentHasManyDeep\HasManyDeep;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;
use Symfony\Component\HttpKernel\Exception\HttpException;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, SoftDeletes,
        HasRoles, EagerLoadPivotTrait, HasRelationships;

    protected $fillable = [
        'name', 'surname', 'email', 'password',
        'profile_photo', 'job_title', 'phone_number',
    ];

    protected $hidden = ['password', 'remember_token',];

    protected $appends = ['clients'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_root' => 'boolean',
        ];
    }

    protected function clients(): Attribute
    {
        return Attribute::get(function () {
            $clients = collect();
            if ($this->relationLoaded('clientsViaTask')) {
                $clients = $clients->merge($this->clientsViaTask);
            }
            if ($this->relationLoaded('clientsViaProject')) {
                $clients = $clients->merge($this->clientsViaProject);
            }
            return $clients->isNotEmpty() ? $clients->unique('id') : null;
        });
    }

    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany(Task::class, 'task_user')->using(
            TaskUser::class)->withPivot(['assigned_by', 'assigned_at'])->as('assignment');
    }

    public function projects(): HasManyDeep
    {
        return $this->hasManyDeepFromRelations(
            $this->tasks(), (new Task())->project())->distinct();
    }

    public function clientsViaTask(): HasManyDeep
    {
        return $this->hasManyDeepFromRelations(
            $this->tasks(), (new Task())->clientDirect())->distinct();
    }

    public function clientsViaProject(): HasManyDeep
    {
        return $this->hasManyDeepFromRelations(
            $this->projects(), (new Project())->client())->distinct();
    }

    protected static function booted(): void
    {
        static::updating(function (User $user) {
            if ($user->is_root && $user->isDirty('is_root')) {
                throw new HttpException(403, 'Root superadmin flag cannot be modified.');
            }
        });

        static::deleting(function (User $user) {
            if ($user->is_root) {
                throw new HttpException(403, 'Root superadmin cannot be deleted.');
            }
        });
    }
}
