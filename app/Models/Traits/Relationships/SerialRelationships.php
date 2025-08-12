<?php

namespace App\Models\Traits\Relationships;

use App\Models\Brand;
use App\Models\Group;
use App\Models\Item;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait SerialRelationships
{
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }
}
