<?php

namespace App\Http\Resources;

use App\Models\Serial;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Serial */
class SerialResource extends JsonResource
{
    public static $wrap = null;
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'sku' => $this->item_itno,
            'in' => $this->in,
            'out' => $this->out,
            'dealerCode' => $this->customer_code,
            'order' => $this->order,
            'item' => ItemResource::make($this->item),
        ];
    }
}
