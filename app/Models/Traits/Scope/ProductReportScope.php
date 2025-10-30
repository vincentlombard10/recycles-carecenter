<?php

namespace App\Models\Traits\Scope;

use App\Models\ProductReport;
use Illuminate\Database\Eloquent\Builder;

trait ProductReportScope
{
    public function scopeInit(): Builder
    {
        return $this->where('status', ProductReport::STATUS_INIT);
    }

    public function scopePending(): Builder
    {
        return $this->where('status', ProductReport::STATUS_PENDING);
    }

    public function scopeInProgress(): Builder
    {
        return $this->where('status', ProductReport::STATUS_IN_PROGRESS);
    }

    public function scopeClosed(): Builder
    {
        return $this->where('status', ProductReport::STATUS_CLOSED);
    }

    public function scopeCancelled(): Builder
    {
        return $this->where('status', ProductReport::STATUS_CANCELLED);
    }
}
