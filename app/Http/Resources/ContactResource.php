<?php

namespace App\Http\Resources;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Contact */
class ContactResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'code' => $this->code,
            'name' => $this->name,
            'zendeskUserID' => $this->zendesk_user_id,
            'status' => $this->status,
            'phone' => $this->phone,
            'email' => $this->email,
            'address1' => $this->address1,
            'address2' => $this->address2,
            'postcode' => $this->postcode,
            'city' => $this->city,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }
}
