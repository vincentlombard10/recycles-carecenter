<?php

namespace App\Models\Traits\Attribute;

use App\Models\Ticket;

trait TicketAttribute
{
    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            Ticket::STATUS_NEW => __('Nouveau'),
            Ticket::STATUS_PENDING, Ticket::STATUS_HOLD => __('En attente'),
            Ticket::STATUS_OPEN => __('Ouvert'),
            TIcket::STATUS_SOLVED => __('Résolu'),
            Ticket::STATUS_CLOSED => __('Clos'),
            default => __('-'),
        };
    }
}
