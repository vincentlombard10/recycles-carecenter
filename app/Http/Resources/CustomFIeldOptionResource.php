<?php

namespace App\Http\Resources;

use App\Models\CustomFIeldOption;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin CustomFIeldOption */
class CustomFIeldOptionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'identifier' => $this->identifier,
            'label' => $this->label,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'custom_field_id' => $this->custom_field_id,

            'customField' => new CustomFieldResource($this->whenLoaded('customField')),
        ];
    }
}
