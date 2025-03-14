<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attachment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'content_type',
        'content_url',
        'deleted',
        'file_name',
        'height',
        'inline',
        'malware_access_override',
        'malware_scan_result',
        'mapped_content_url',
        'size',
        'thumbnails',
        'url',
        'width',
        'comment_id',
    ];

    public function comment(): BelongsTo
    {
        return $this->belongsTo(Comment::class);
    }

    protected function casts(): array
    {
        return [
            'deleted' => 'boolean',
            'inline' => 'boolean',
            'malware_access_override' => 'boolean',
            'thumbnails' => 'array',
        ];
    }
}
