<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\Scope\TicketFieldScope;

class CustomField extends Model
{
    use SoftDeletes,
        TicketFieldScope;

    protected $table = 'ticketfields';

    protected $fillable = [
        'name',
        'type',
    ];

    public function options(): HasMany
    {
        return $this->hasMany(CustomFieldOption::class)->orderBy('position', 'ASC');
    }
}
