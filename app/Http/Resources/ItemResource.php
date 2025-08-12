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
            'group' => new GroupResource($this->group),
            'brand' => new BrandResource($this->brand),
        ];
    }
}
