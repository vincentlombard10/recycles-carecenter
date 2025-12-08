<?php

trait TicketFieldScope
{
    public function scopeExportable($query)
    {
        return $query->where('exportable', true);
    }
}
