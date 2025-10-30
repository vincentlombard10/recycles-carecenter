<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class BatteryState extends Model
{
    protected $table = 'batterystates';

    public function reports(): BelongsToMany
    {
        return $this->belongsToMany(ProductReport::class, 'batterystate_productreport', 'batterystate_id', 'productreport_id');
    }
}
