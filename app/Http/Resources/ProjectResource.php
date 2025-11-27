<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'client' => ClientResource::make($this->whenLoaded('client')),
            'description' => $this->description,
            'cover_photo' => $this->cover_photo,
            'status' => $this->status,
            'tasks' => TaskResource::collection($this->whenLoaded('tasks')),
            'users' => UserResource::collection($this->whenLoaded('users')),
            'created_at' => $this->created_at,
        ];
    }
}
