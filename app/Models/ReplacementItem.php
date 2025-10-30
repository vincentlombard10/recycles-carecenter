<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReplacementItem extends Model
{
    protected $table = 'replacement_items';

    protected $guarded = ['id'];

    public function productReturn(): BelongsTo
    {
        return $this->belongsTo(ProductReport::class, 'productreport_id');
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
