<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $fields = [];
        $fields['id'] = $this->id;
        $fields['name'] = $this->name;
        $fields['ra'] = $this->ra;

        return $fields;
    }
}
