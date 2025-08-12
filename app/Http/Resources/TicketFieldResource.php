<?php

namespace App\Http\Resources;

use App\Models\Zendesk\TicketField;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin TicketField */
class TicketFieldResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'title' => $this->title,
            'raw_title' => $this->raw_title,
            'description' => $this->description,
            'raw_description' => $this->raw_description,
            'position' => $this->position,
            'active' => $this->active,
            'required' => $this->required,
            'collapsed_for_agents' => $this->collapsed_for_agents,
            'regexp_for_validation' => $this->regexp_for_validation,
            'title_in_portal' => $this->title_in_portal,
            'raw_title_in_portal' => $this->raw_title_in_portal,
            'visible_in_portal' => $this->visible_in_portal,
            'editable_in_portal' => $this->editable_in_portal,
            'required_in_portal' => $this->required_in_portal,
            'agent_can_edit' => $this->agent_can_edit,
            'tag' => $this->tag,
            'removable' => $this->removable,
            'key' => $this->key,
            'agent_description' => $this->agent_description,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
