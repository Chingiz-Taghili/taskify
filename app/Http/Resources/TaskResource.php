<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user' => new UserResource($this->whenLoaded('user')),
            'client' => new ClientResource($this->whenLoaded('client')),
            'project' => new ProjectResource($this->whenLoaded('project')),
            'category' => new CategoryResource($this->whenLoaded('category')),
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'assigned_by' => new UserResource($this->whenLoaded('assignedBy')),
            'assigned_at' => $this->assigned_at,
            'parent' => new TaskResource($this->whenLoaded('parent')),
            'children' => TaskResource::collection($this->whenLoaded('children')),
            'due_date' => $this->due_date,
            'created_at' => $this->created_at,
        ];
    }
}
