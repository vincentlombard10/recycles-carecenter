<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{

    /**
     * @var string[]
     */
    protected $with = [
        'permissions',
    ];
}
