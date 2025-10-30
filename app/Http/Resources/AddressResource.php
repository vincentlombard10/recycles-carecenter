<?php

namespace App\Http\Resources;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Address */
class AddressResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'address1' => $this->address1,
            'address2' => $this->address2,
            'postcode' => $this->postcode,
            'city' => $this->city,
            'is_primary' => $this->is_primary,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'contact_id' => $this->contact_id,

            'contact' => new ContactResource($this->whenLoaded('contact')),
        ];
    }
}
