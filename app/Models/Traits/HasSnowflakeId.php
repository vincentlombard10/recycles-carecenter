<?php

namespace App\Models\Traits;

use App\Support\Snowflake;

trait HasSnowflakeId
{
    public static function bootHasSnowflakeId()
    {
        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = Snowflake::generate();
            }
        });
    }

    public function initializeHasSnowflakeId()
    {
        $this->incrementing = false;
        $this->keyType = 'int';
    }
}
