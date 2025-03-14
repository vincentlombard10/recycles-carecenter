<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id',
        'name',
        'zendesk_user_id',
        'status',
        'address1',
        'address2',
        'postalcode',
        'city',
        'country',
        'salesrep',
        'phone',
        'email',
    ];

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            20 => 'Actif',
            90 => 'Fermé',
        };
    }

    public function getStatusClassAttribute(): string
    {
        return match($this->status) {
            20 => 'Actif',
            90 => 'Fermé',
        };
    }
}
