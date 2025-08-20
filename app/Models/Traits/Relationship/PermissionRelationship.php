<?php

namespace App\Models\Traits\Relationship;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait PermissionRelationship
{
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Permission::class, 'parent_id')->with('parent');
    }

    /**
     * @return mixed
     */
    public function children(): HasMany
    {
        return $this->hasMany(Permission::class, 'parent_id')->with('children');
    }
}
