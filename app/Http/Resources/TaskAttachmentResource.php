<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskAttachmentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'task' => new TaskResource($this->whenLoaded('task')),
            'file_path' => $this->file_path,
            'mime_type' => $this->mime_type,
            'sort_order' => $this->sort_order,
            'created_at' => $this->created_at,
        ];
    }
}
