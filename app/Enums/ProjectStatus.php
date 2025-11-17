<?php

namespace App\Enums;

enum ProjectStatus: string
{
    case PLANNED = 'planned';
    case ACTIVE = 'active';
    case ON_HOLD = 'on_hold';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';
}
