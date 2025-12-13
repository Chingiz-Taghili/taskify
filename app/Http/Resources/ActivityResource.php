<?php

namespace App\Http\Resources;

use App\Enums\SubjectType;
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
            'subject' => $this->whenLoaded('subject', function () {
                $resourceClass = SubjectType::resourceClassFor($this->subject_type);
                return $resourceClass::make($this->subject);
            }),
            'causer' => UserResource::make($this->whenLoaded('causer')),
            'properties' => $this->properties,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
