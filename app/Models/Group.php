<?php

namespace App\Models;

use App\Models\Traits\Relationship\GroupRelationship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use SoftDeletes,
        GroupRelationship;

    protected $table = 'groups';

    protected $guarded = ['id'];
}
