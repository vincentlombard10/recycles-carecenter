<?php

namespace App\Models;

use App\Models\Traits\Relationship\BrandRelationship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use SoftDeletes,
        BrandRelationship;

    protected $table = 'brands';

    protected $primaryKey = 'id';

    protected $guarded = ['id'];
}
