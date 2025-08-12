<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SerialAdditional extends Model
{
    use SoftDeletes;

    protected $table = 'serials_additionals';

    protected $guarded = ['id'];

    public function serial(): BelongsTo
    {
        return $this->belongsTo(Serial::class);
    }
}
