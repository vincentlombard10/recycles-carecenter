<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BomItem extends Model
{
    protected $table = 'bomitems';

    protected $guarded = ['id'];

    public function bom(): BelongsTo
    {
        return $this->belongsTo(Bom::class, 'bom_id', 'id');
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }
}
