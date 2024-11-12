<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $fields = [];
        $fields['name'] = $this->name;
        $fields['department'] = $this->department;
        $fields['is_active'] = $this->is_active;
        $fields['teacher'] = new ProfessorResource($this->whenLoaded('teacher'));
        $fields['students'] = StudentResource::collection($this->whenLoaded('students'));

        return $fields;
    }
}
