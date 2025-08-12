<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\Relationships\SerialRelationships;

class Serial extends Model
{
    use SoftDeletes,
        SerialRelationships;

    protected $table = 'serials';

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'in' => 'timestamp',
            'out' => 'timestamp',
        ];
    }
}
