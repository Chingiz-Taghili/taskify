<?php

namespace App\Http\Resources;

use App\Models\Category;
use App\Models\Client;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ActivityResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'log_name' => $this->log_name,
            'description' => $this->description,
            'event' => $this->event,
            'subject' => $this->relationLoaded('subject') ? match (true) {
                $this->subject instanceof Category => CategoryResource::make($this->subject),
                $this->subject instanceof Client => ClientResource::make($this->subject),
                $this->subject instanceof Project => ProjectResource::make($this->subject),
                $this->subject instanceof Task => TaskResource::make($this->subject),
                $this->subject instanceof User => UserResource::make($this->subject),
            } : null,
            'causer' => UserResource::make($this->whenLoaded('causer')),
            'properties' => $this->properties,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
