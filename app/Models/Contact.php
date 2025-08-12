<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\Attributes\ContactAttributes;

class Contact extends Model
{
    use SoftDeletes,
        ContactAttributes;

    protected $guarded = ['id'];

}
