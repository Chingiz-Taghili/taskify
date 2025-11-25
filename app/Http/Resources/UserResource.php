<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'surname' => $this->surname,
            'email' => $this->email,
            'profile_photo' => $this->profile_photo,
            'job_title' => $this->job_title,
            'phone_number' => $this->phone_number,
            'roles' => $this->getRoleNames(),
            'tasks' => TaskResource::collection($this->whenLoaded('tasks')),
            'assignment' => $this->whenPivotLoadedAs('assignment', 'task_user', function () {
                return [
                    'assigned_by' => $this->assignment->relationLoaded('assignedBy')
                        ? UserResource::make($this->assignment->assignedBy) : null,
                    'assigned_at' => $this->assignment->assigned_at,];
            }),
            'created_at' => $this->created_at,
        ];
    }
}
