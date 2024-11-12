<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $fields = [];
        $fields['file_name'] = $this->file_name;
        $fields['file_content'] = $this->file_content;
        $fields['user_id'] = $this->user_id;
        $fields['student_id'] = $this->student_id;

        return $fields;
    }
}
