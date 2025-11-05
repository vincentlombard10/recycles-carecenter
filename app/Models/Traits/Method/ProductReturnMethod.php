<?php

namespace App\Models\Traits\Method;

use App\Models\ProductReturn;

trait ProductReturnMethod
{
    public function isIncomplete(): bool
    {
        return $this->status === ProductReturn::STATUS_INCOMPLETE;
    }

    public function isPending(): bool
    {
        return $this->status === ProductReturn::STATUS_PENDING;
    }

    public function isReceived(): bool
    {
        return $this->status === ProductReturn::STATUS_RECEIVED;
    }

    public function isCancelled(): bool
    {
        return $this->status === ProductReturn::STATUS_CANCELLED;
    }
}
