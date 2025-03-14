<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'attachments',
        'audit_id',
        'author_id',
        'body',
        'html_body',
        'metadata',
        'plain_body',
        'public',
        'type',
        'uploads',
        'via',
        'ticket_id',
    ];

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }

    protected function casts(): array
    {
        return [
            'attachments' => 'array',
            'created_at' => 'timestamp',
            'metadata' => 'array',
            'public' => 'boolean',
            'uploads' => 'array',
            'via' => 'array',
        ];
    }
}
