<?php

namespace App\Models\Traits\Relationship;

use App\Models\Brand;
use App\Models\Group;
use App\Models\Item;
use App\Models\SerialAdditional;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait SerialRelationship
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

    public function additionals(): HasMany
    {
        return $this->hasMany(SerialAdditional::class);
    }
}
