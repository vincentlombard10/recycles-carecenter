<?php

namespace App\Models\Traits\Scope;

trait TicketFieldScope
{
    public function scopeExportable($query)
    {
        return $query->where('exportable', true);
    }
}
