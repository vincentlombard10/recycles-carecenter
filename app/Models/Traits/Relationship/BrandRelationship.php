<?php

namespace App\Models\Traits\Relationship;

use App\Models\Item;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait BrandRelationship
{
    public function items(): HasMany
    {
        return $this->hasMany(Item::class, 'brand_id', 'id');
    }
}
