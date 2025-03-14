<?php

namespace App\Http\Resources;

use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Attachment */
class AttachmentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'content_type' => $this->content_type,
            'content_url' => $this->content_url,
            'deleted' => $this->deleted,
            'file_name' => $this->file_name,
            'height' => $this->height,
            'inline' => $this->inline,
            'malware_access_override' => $this->malware_access_override,
            'malware_scan_result' => $this->malware_scan_result,
            'mapped_content_url' => $this->mapped_content_url,
            'size' => $this->size,
            'thumbnails' => $this->thumbnails,
            'url' => $this->url,
            'width' => $this->width,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'comment_id' => $this->comment_id,

            'comment' => new CommentResource($this->whenLoaded('comment')),
        ];
    }
}
