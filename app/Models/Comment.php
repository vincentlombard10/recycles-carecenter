<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    const UPDATED_AT = null;

    protected $table = 'comments';

    protected $guarded = [];

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

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }
}
