<?php

namespace App\Models\Traits\Scope;

use Illuminate\Database\Eloquent\Builder;

trait TicketScope
{
    public function scopeNew(): Builder
    {
        return $this->where('status', 'New');
    }

    public function scopeOpen(): Builder
    {
        return $this->where('status', 'Open');
    }

    public function scopeHoldOrPending(): Builder
    {
        return $this->where('status', 'Hold')
            ->orWhere('status', 'Pending');
    }
}
