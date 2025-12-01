<?php

namespace App\Models\Traits\Attribute;

use App\Models\ProductReport;

trait ProductReportAttribute
{
    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            ProductReport::STATUS_INIT => __('Retour en attente'),
            ProductReport::STATUS_PENDING => __('En attente'),
            ProductReport::STATUS_IN_PROGRESS => __('En cours'),
            ProductReport::STATUS_CLOSED => __('Terminé'),
            ProductReport::STATUS_PAUSED => __('Devis en attente'),
            ProductReport::STATUS_CANCELLED => __('Annulé'),
            default => __('-'),
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            ProductReport::STATUS_INIT => 'bg-white',
            ProductReport::STATUS_PENDING => 'bg-orange-200',
            ProductReport::STATUS_IN_PROGRESS => 'progress',
            ProductReport::STATUS_CLOSED => 'closed',
            ProductReport::STATUS_PAUSED => 'pending',
            ProductReport::STATUS_CANCELLED => 'cancelled',
            default => __('-'),
        };
    }

    public function getBatteryKeyLabelAttribute(): string
    {
        return match($this->battery_key) {
            'yes' => 'Oui',
            'no' => 'Non',
            'none' => 'Non équipé',
            default => __('-'),
        };
    }
    public function getLockKeyLabelAttribute(): string
    {
        return match($this->battery_key) {
            'yes' => 'Oui',
            'no' => 'Non',
            'none' => 'Non équipé',
            default => __('-'),
        };
    }
    public function getChargerLabelAttribute(): string
    {
        return match($this->battery_key) {
            'yes' => 'Oui',
            'no' => 'Non',
            'none' => 'Non équipé',
            default => __('-'),
        };
    }
    public function getBatteryLabelAttribute(): string
    {
        return match($this->battery_key) {
            'yes' => 'Oui',
            'no' => 'Non',
            'none' => 'Non équipé',
            default => __('-'),
        };
    }
    public function getPedalsLabelAttribute(): string
    {
        return match($this->battery_key) {
            'yes' => 'Oui',
            'no' => 'Non',
            'none' => 'Non équipé',
            default => __('-'),
        };
    }
    public function getFrontWheelLabelAttribute(): string
    {
        return match($this->battery_key) {
            'yes' => 'Oui',
            'no' => 'Non',
            'none' => 'Non équipé',
            default => __('-'),
        };
    }
    public function getRearWheelLabelAttribute(): string
    {
        return match($this->battery_key) {
            'yes' => 'Oui',
            'no' => 'Non',
            'none' => 'Non équipé',
            default => __('-'),
        };
    }
    public function getSaddleLabelAttribute(): string
    {
        return match($this->battery_key) {
            'yes' => 'Oui',
            'no' => 'Non',
            'none' => 'Non équipé',
            default => __('-'),
        };
    }
    public function getSeatpostLabelAttribute(): string
    {
        return match($this->battery_key) {
            'yes' => 'Oui',
            'no' => 'Non',
            'none' => 'Non équipé',
            default => __('-'),
        };
    }
    public function getDisplayLabelAttribute(): string
    {
        return match($this->battery_key) {
            'yes' => 'Oui',
            'no' => 'Non',
            'none' => 'Non équipé',
            default => __('-'),
        };
    }
    public function getMotorLabelAttribute(): string
    {
        return match($this->battery_key) {
            'yes' => 'Oui',
            'no' => 'Non',
            'none' => 'Non équipé',
            default => __('-'),
        };
    }

    public function getStripesLabelAttribute(): string
    {
        return match($this->stripes) {
            'yes' => 'Oui',
            'no' => 'Non',
            default => __('-'),
        };
    }

    public function getCorrosionLabelAttribute(): string
    {
        return match($this->corrosion) {
            'yes' => 'Oui',
            'no' => 'Non',
            default => __('-'),
        };
    }

    public function getClayLabelAttribute(): string
    {
        return match($this->clay) {
            'yes' => 'Oui',
            'no' => 'Non',
            default => __('-'),
        };
    }

    public function getSandLabelAttribute(): string
    {
        return match($this->sand) {
            'yes' => 'Oui',
            'no' => 'Non',
            default => __('-'),
        };
    }

    public function getImpactsLabelAttribute(): string
    {
        return match($this->impacts) {
            'yes' => 'Oui',
            'no' => 'Non',
            default => __('-'),
        };
    }

    public function getCracksLabelAttribute(): string
    {
        return match($this->cracks) {
            'yes' => 'Oui',
            'no' => 'Non',
            default => __('-'),
        };
    }

    public function getBreakageLabelAttribute(): string
    {
        return match($this->breakage) {
            'yes' => 'Oui',
            'no' => 'Non',
            default => __('-'),
        };
    }

    public function getModificationLabelAttribute(): string
    {
        return match($this->modification) {
            'yes' => 'Oui',
            'no' => 'Non',
            default => __('-'),
        };
    }

    public function getBatteryNominalVoltageLabelAttribute(): string
    {
        return sprintf('%.02f %s', $this->battery_nominal_voltage, 'V');
    }

    public function getBatteryNominalCapacityLabelAttribute(): string
    {
        return sprintf('%.02f %s', $this->battery_nominal_capacity, 'Ah');
    }

    public function getBatteryIndicatorLabelAttribute(): string
    {
        return match($this->battery_indicator) {
            'yes' => 'Oui',
            'no' => 'Non',
            default => __('-'),
        };
    }

    public function getBatteryErrorCodesLabelAttribute(): string
    {
        return $this->battery_error_codes ?? '-';
    }

    public function getBatteryChargeStateLabelAttribute(): string
    {
        return match($this->battery_charge_state) {
            'good' => 'Oui',
            'bad' => 'Non',
            default => __('-'),
        };
    }

    public function getBatteryChargeVoltageLabelAttribute(): string
    {
        return sprintf('%.02f %s', $this->battery_charge_voltage, 'V');
    }

    public function getBatteryEnergyLabelAttribute(): string
    {
        return sprintf('%.02f %s', $this->battery_energy, 'Ah');
    }


    public function getBatteryCellsStateLabelAttribute(): string
    {
        return match($this->battery_cells_state) {
            'stable' => 'Equilibre (< 0,2V par cellule)',
            'unstable' => 'Déséquilibre : (> 0,2V par cellule)',
            default => __('-'),
        };
    }

    public function getBatteryTemperatureLabelAttribute(): string
    {
        return match($this->battery_temperature) {
            'low' => 'Faible : < 0°C',
            'normal' => 'Normale : entre 0°C et 45°C',
            'high' => 'Elevée : > 45°C',
            default => '-'
        };
    }

    public function getBatteryInternalResistanceLabelAttribute(): string
    {
        return sprintf('%s %s', $this->battery_internal_resistance, 'mOhm');
    }
}
