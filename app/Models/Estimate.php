<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use SebastianBergmann\CodeCoverage\Report\Xml\Report;

class Estimate extends Model
{
    protected $table = 'estimates';

    protected $guarded = ['id'];

    public const STATUS_PENDING = 'pending';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_REJECTED = 'rejected';

    public function report(): BelongsTo
    {
        return $this->belongsTo(ProductReport::class, 'productreport_id');
    }

    public function scopePending($query)
    {
        return $query->where('status', Estimate::STATUS_PENDING);
    }

    public function scopeApproved($query)
    {
        return $query->where('status', Estimate::STATUS_APPROVED);
    }

    public function scopeRejected($query)
    {
        return $query->where('status', Estimate::STATUS_REJECTED);
    }
}
