<?php

namespace App\Http\Resources;

use App\Models\Dealer;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Dealer */
class DealerResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'name' => $this->name,
        ];
    }
}
