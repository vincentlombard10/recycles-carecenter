<?php

namespace App\Models\Traits\Relationship;

use App\Models\Serial;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait SerialAdditionalRelationship
{
    public function serial(): BelongsTo
    {
        return $this->belongsTo(Serial::class);
    }
}
