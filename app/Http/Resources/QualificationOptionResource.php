<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QualificationOptionResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'marker' => $this->marker,
            'name' => $this->name,
            'position' => $this->position,
        ];
    }
}
