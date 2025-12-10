<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Staudenmeir\EloquentHasManyDeep\HasManyDeep;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Category extends Model
{
    use HasFactory, SoftDeletes, HasRelationships, LogsActivity;

    protected $fillable = ['name', 'description',];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function users(): HasManyDeep
    {
        return $this->hasManyDeepFromRelations(
            $this->tasks(), (new Task())->users())->distinct();
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'description'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->useLogName('category')
            ->setDescriptionForEvent(fn(string $event) => "Category {$event}");
    }

    protected static function booted(): void
    {
        static::creating(function ($category) {
            $baseSlug = Str::slug($category->name);
            $slug = $baseSlug;
            $count = 1;
            $existingSlugs = Category::where('slug', 'like', $baseSlug . '%')->pluck('slug')->toArray();
            while (in_array($slug, $existingSlugs)) {
                $slug = $baseSlug . '-' . $count++;
            }
            $category->slug = $slug;
        });
    }
}
