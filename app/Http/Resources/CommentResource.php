<?php

namespace App\Http\Resources;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Comment */
class CommentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'attachments' => $this->attachments,
            'audit_id' => $this->audit_id,
            'author_id' => $this->author_id,
            'body' => $this->body,
            'html_body' => $this->html_body,
            'metadata' => $this->metadata,
            'plain_body' => $this->plain_body,
            'public' => $this->public,
            'type' => $this->type,
            'uploads' => $this->uploads,
            'via' => $this->via,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'ticket_id' => $this->ticket_id,

            'ticket' => new TicketResource($this->whenLoaded('ticket')),
        ];
    }
}
