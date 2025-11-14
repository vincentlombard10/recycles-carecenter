<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use SebastianBergmann\CodeCoverage\Report\Xml\Report;

class Estimate extends Model
{
    protected $table = 'estimates';

    protected $guarded = ['id'];

    public function report(): BelongsTo
    {
        return $this->belongsTo(ProductReport::class, 'productreport_id');
    }
}
