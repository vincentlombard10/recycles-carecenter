<?php

namespace App\Models\Traits\Attribute;

trait ProductReturnAttribute
{
    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            self::STATUS_INCOMPLETE => __('Incomplet'),
            self::STATUS_PENDING => __('En attente'),
            self::STATUS_RECEIVED => __('Reçu'),
            self::STATUS_CANCELLED => __('Annulé'),
            default => __('-'),
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            self::STATUS_INCOMPLETE => 'incomplete',
            self::STATUS_PENDING => 'pending',
            self::STATUS_RECEIVED => 'received',
            self::STATUS_CANCELLED => 'cancelled',
            default => __('-'),
        };
    }

    public function getTypeLabelAttribute(): string
    {
        return match($this->type) {
            'component', 'composant' => __('Composant'),
            'bike', 'velo', => __('Vélo'),
            'battery', 'batterie' => __('Batterie'),
            default => __('-'),
        };
    }

    public function getContextLabelAttribute(): string
    {
        return match($this->context) {
            'warranty', 'garantie' => __('Garantie'),
            'out-of-warranty', 'hors_garantie' => __('Hors garantie'),
            'entretien' => __('Entretien'),
            default => __('-'),
        };
    }

    public function getReasonLabelAttribute(): string
    {
        return match($this->reason) {
            'erreur_client' => __('Erreur client'),
            'erreur_interne' => __('Erreur interne'),
            'panne_electrique' => __('Panne électrique'),
            'panne_mecanique' => __('Panne mécanique'),
            'velo_pret' => __('Velo pret'),
            'velo_salon' => __('Velo salon'),
            'geste_commercial' => __('Geste commercial'),
            default => __('Inconnu')
        };
    }

    public function getAssignationLabelAttribute(): string
    {
        return match($this->assignation) {
            default => __('-'),
        };
    }

    public function getActionLabelAttribute(): string
    {
        return match($this->action) {
            default => __('-'),
        };
    }

    public function getDestinationLabelAttribute(): string
    {
        return match($this->destination) {
            default => __('-'),
        };
    }

}
