<?php

namespace App\Models\Traits\Relationship;

use App\Models\BatteryState;
use App\Models\ProductReport;
use App\Models\ProductReturn;
use App\Models\ReplacementItem;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait ProductReportRelationship
{
    public function return(): BelongsTo
    {
        return $this->belongsTo(ProductReturn::class, 'productreturn_id');
    }

    public function technician(): BelongsTo
    {
        return $this->belongsTo(User::class, 'technician_id');
    }

    public function replacementItems(): HasMany
    {
        return $this->hasMany(ReplacementItem::class, 'productreport_id');
    }

    public function batteryStates(): BelongsToMany
    {
        return $this->belongsToMany(BatteryState::class, 'batterystate_productreport', 'productreport_id', 'batterystate_id');
    }
}
