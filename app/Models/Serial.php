<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Serial extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'code',
        'item_itno',
        'in',
        'out',
        'customer_code',
        'order',
        'delivery',
        'group_code',
        'brand_code',
        'group_id',
        'brand_id',
        'item_id',
    ];

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

    protected function casts(): array
    {
        return [
            'in' => 'timestamp',
            'out' => 'timestamp',
        ];
    }
}
