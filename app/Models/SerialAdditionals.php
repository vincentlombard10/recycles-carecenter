<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SerialAdditionals extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'serial_code',
        'serial_id',
        'qualificiation',
        'reference',
        'category',
    ];

    public function serial(): BelongsTo
    {
        return $this->belongsTo(Serial::class);
    }
}
