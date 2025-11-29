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
            'client' => $this->when($this->client, fn() => ClientResource::make($this->client)),
            'project' => ProjectResource::make($this->whenLoaded('project')),
            'category' => CategoryResource::make($this->whenLoaded('category')),
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'parent' => TaskResource::make($this->whenLoaded('parent')),
            'children' => TaskResource::collection($this->whenLoaded('children')),
            'due_date' => $this->due_date?->toIso8601String(),
            'assignment' => $this->whenPivotLoadedAs('assignment', 'task_user', function () {
                return [
                    'assigned_by' => $this->assignment->relationLoaded('assignedBy')
                        ? UserResource::make($this->assignment->assignedBy) : null,
                    'assigned_at' => $this->assignment->assigned_at?->toIso8601String(),];
            }),
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
