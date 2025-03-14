<?php

namespace App\Http\Resources;

use App\Models\Serial;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Serial */
class SerialResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'item_itno' => $this->item_itno,
            'in' => $this->in,
            'out' => $this->out,
            'dealer_code' => $this->dealer_code,
            'order' => $this->order,
            'delivery' => $this->delivery,
            'group_code' => $this->group_code,
            'brand_code' => $this->brand_code,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'group_id' => $this->group_id,
            'brand_id' => $this->brand_id,
            'item_id' => $this->item_id,

            'group' => new GroupResource($this->whenLoaded('group')),
            'brand' => new BrandResource($this->whenLoaded('brand')),
            'item' => new ItemResource($this->whenLoaded('item')),
        ];
    }
}
