<?php

namespace App\Models\Traits\Attributes;

trait ProductReturnAttributes
{
    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            self::STATUS_PENDING => __('En attente'),
            self::STATUS_RECEIVED => __('Reçu'),
            self::STATUS_FIRST_QUOTATION => __('Devis 2'),
            self::STATUS_FIRST_QUOTATION_REMINDER => __('Relance Devis 1'),
            self::STATUS_FIRST_QUOTATION_APPROVED => __('Devis 1 accepté'),
            self::STATUS_FIRST_QUOTATION_REJECTED => __('Devis 1 refusé'),
            self::STATUS_SECOND_QUOTATION => __('Devis 2'),
            self::STATUS_SECOND_QUOTATION_REMINDER => __('Relance devis 2'),
            self::STATUS_SECOND_QUOTATION_APPROVED => __('Devis 2 accepté'),
            self::STATUS_SECOND_QUOTATION_REJECTED => __('Devis 2 refusé'),
            self::STATUS_SHIPPED => __('Expédié'),
            self::STATUS_FINISHED => __('Fin de processus'),
            self::STATUS_CANCELLED => __('Annulé'),
            default => __('-'),
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            self::STATUS_PENDING => 'pending',
            self::STATUS_RECEIVED => 'received',
            self::STATUS_FIRST_QUOTATION => 'first-quotation',
            self::STATUS_FIRST_QUOTATION_REMINDER => 'first-quotation-reminder',
            self::STATUS_FIRST_QUOTATION_APPROVED => 'first-quotation-approved',
            self::STATUS_FIRST_QUOTATION_REJECTED => 'first-quotation-rejected',
            self::STATUS_SECOND_QUOTATION => 'second-quotation',
            self::STATUS_SECOND_QUOTATION_REMINDER => 'second-quotation-reminder',
            self::STATUS_SECOND_QUOTATION_APPROVED => 'second-quotation-approved',
            self::STATUS_SECOND_QUOTATION_REJECTED => 'second-quotation-rejected',
            self::STATUS_SHIPPED => 'shipping',
            self::STATUS_FINISHED => 'process-finished',
            self::STATUS_CANCELLED => 'cancelled',
            default => __('-'),
        };
    }

    public function getTypeLabelAttribute(): string
    {
        return match($this->type) {
            'component' => __('Component'),
            'bike' => __('Bike'),
            default => __('-'),
        };
    }

    public function getContextLabelAttribute(): string
    {
        return match($this->context) {
            'warranty' => __('Warranty'),
            'out-of-warranty' => __('Out of Warranty'),
            default => __('-'),
        };
    }
}
