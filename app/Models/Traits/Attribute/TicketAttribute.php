<?php

namespace App\Models\Traits\Attribute;

use App\Models\Ticket;

trait TicketAttribute
{
    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            Ticket::STATUS_NEW, 'new' => __('Nouveau'),
            Ticket::STATUS_PENDING, Ticket::STATUS_HOLD, 'hold', 'pending' => __('En attente'),
            Ticket::STATUS_OPEN, 'open' => __('Ouvert'),
            TIcket::STATUS_SOLVED, 'solved' => __('Résolu'),
            Ticket::STATUS_CLOSED, 'closed' => __('Clos'),
            default => __('-'),
        };
    }
}
