<?php

namespace App\Models\Traits\Attributes;

trait ContactAttributes
{
    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            20 => __('Open'),
            90 => __('Closed'),
        };
    }

    public function getStatusClassAttribute(): string
    {
        return match($this->status) {
            20 => __('Open'),
            90 => __('Closed'),
        };
    }
}
