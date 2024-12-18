<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfessorResource extends JsonResource
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
        $fields['email'] = $this->email;
        $fields['role'] = $this->role;

        return $fields;
    }
}
