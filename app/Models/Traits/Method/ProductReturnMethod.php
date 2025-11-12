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

    public function isSandboxed(): bool
    {
        return $this->environment === ProductReturn::ENV_SANDBOX;
    }

    public function isProduction(): bool
    {
        return $this->environment === ProductReturn::ENV_PRODUCTION;
    }
}
