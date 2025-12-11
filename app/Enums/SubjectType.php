<?php

namespace App\Enums;

enum SubjectType: string
{
    case CATEGORY = 'category';
    case CLIENT = 'client';
    case PROJECT = 'project';
    case TASK = 'task';
    case USER = 'user';

    public function fullType(): string
    {
        return match ($this) {
            self::CATEGORY => 'App\Models\Category',
            self::CLIENT => 'App\Models\Client',
            self::PROJECT => 'App\Models\Project',
            self::TASK => 'App\Models\Task',
            self::USER => 'App\Models\User',
        };
    }
}
