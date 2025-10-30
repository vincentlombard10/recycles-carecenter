<?php

namespace App\Models\Traits\Scope;

use App\Models\ProductReturn;
use Illuminate\Database\Eloquent\Builder;

trait ProductReturnScope
{
    public function scopeIncomplete(): Builder
    {
        return $this->where('status', ProductReturn::STATUS_INCOMPLETE);
    }

    public function scopePending(): Builder
    {
        return $this->where('status', ProductReturn::STATUS_PENDING);
    }

    public function scopeReceived(): Builder
    {
        return $this->where('status', ProductReturn::STATUS_RECEIVED);
    }

    public function scopeCancelled(): Builder
    {
        return $this->where('status', ProductReturn::STATUS_CANCELLED);
    }

}
