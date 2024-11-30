<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
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
        $fields['title'] = $this->title;
        $fields['comment'] = $this->comment;
        $fields['read'] = $this->read;
        $fields['metadata'] = $this->metadata;
        $fields['created_at'] = $this->created_at;

        return $fields;
    }
}
