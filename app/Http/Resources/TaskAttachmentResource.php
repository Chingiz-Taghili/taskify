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
            'task' => TaskResource::make($this->whenLoaded('task')),
            'file_path' => $this->file_path,
            'order_index' => $this->order_index,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
