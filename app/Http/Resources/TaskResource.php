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
            'users' => UserResource::collection($this->whenLoaded('users')),
            'client' => new ClientResource($this->whenLoaded('client')),
            'project' => new ProjectResource($this->whenLoaded('project')),
            'category' => new CategoryResource($this->whenLoaded('category')),
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'parent' => new TaskResource($this->whenLoaded('parent')),
            'children' => TaskResource::collection($this->whenLoaded('children')),
            'due_date' => $this->due_date,
            'assignment' => $this->whenPivotLoaded('task_user', [
                'assigned_by' => new UserResource($this->pivot->assignedBy),
                'assigned_at' => $this->pivot->assigned_at,
            ]),
            'created_at' => $this->created_at,
        ];
    }
}
