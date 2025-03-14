<?php

namespace App\Http\Resources;

use App\Models\SerialAdditionals;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin SerialAdditionals */
class SerialAdditionalsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'serial_code' => $this->serial_code,
            'qualificiation' => $this->qualificiation,
            'reference' => $this->reference,
            'category' => $this->category,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'serial_id' => $this->serial_id,

            'serial' => new SerialResource($this->whenLoaded('serial')),
        ];
    }
}
