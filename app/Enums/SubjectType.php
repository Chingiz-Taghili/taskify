<?php

namespace App\Enums;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\ClientResource;
use App\Http\Resources\ProjectResource;
use App\Http\Resources\TaskAttachmentResource;
use App\Http\Resources\TaskResource;
use App\Http\Resources\UserResource;
use App\Models\Category;
use App\Models\Client;
use App\Models\Project;
use App\Models\Task;
use App\Models\TaskAttachment;
use App\Models\User;

enum SubjectType: string
{
    case CATEGORY = 'category';
    case CLIENT = 'client';
    case PROJECT = 'project';
    case TASK = 'task';
    case TASK_ATTACHMENT = 'task_attachment';
    case USER = 'user';

    public function toFullType(): string
    {
        return match ($this) {
            self::CATEGORY => Category::class,
            self::CLIENT => Client::class,
            self::PROJECT => Project::class,
            self::TASK => Task::class,
            self::TASK_ATTACHMENT => TaskAttachment::class,
            self::USER => User::class,
        };
    }

    public static function resourceClassFor(string $fullType): string
    {
        return match ($fullType) {
            Category::class => CategoryResource::class,
            Client::class => ClientResource::class,
            Project::class => ProjectResource::class,
            Task::class => TaskResource::class,
            TaskAttachment::class => TaskAttachmentResource::class,
            User::class => UserResource::class,
        };
    }
}
