<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'logo' => $this->logo,
            'notes' => $this->notes,
            'projects' => ProjectResource::collection($this->whenLoaded('projects')),
            'tasks' => $this->when($this->tasks, fn() => TaskResource::collection($this->tasks)),
            'users' => $this->when($this->users, fn() => UserResource::collection($this->users)),
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
