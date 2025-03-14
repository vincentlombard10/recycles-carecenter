<?php

namespace App\Http\Resources;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Item */
class ItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'itno' => $this->itno,
            'itds' => $this->itds,
            'label' => $this->label,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'group_id' => $this->group_id,
            'brand_id' => $this->brand_id,

            'group' => new GroupResource($this->whenLoaded('group')),
            'brand' => new BrandResource($this->whenLoaded('brand')),
        ];
    }
}
