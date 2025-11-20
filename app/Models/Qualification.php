<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasSnowflakeId;
class Qualification extends Model
{
    use HasSnowflakeId;
    protected $fillable = ['name', 'description', 'position', 'status'];

    public function options()
    {

    }

}
