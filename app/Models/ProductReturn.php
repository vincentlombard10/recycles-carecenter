<?php

namespace App\Models;

use App\Models\Traits\Attribute\ProductReturnAttribute;
use App\Models\Traits\Method\ProductReturnMethod;
use App\Models\Traits\Relationship\ProductReturnRelationship;
use App\Models\Traits\Scope\ProductReturnScope;
use App\Observers\ProductReturnObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy(ProductReturnObserver::class)]
class ProductReturn extends Model
{

    protected $table = 'productreturns';
    use SoftDeletes,
        ProductReturnScope,
        ProductReturnAttribute,
        ProductReturnRelationship,
        ProductReturnMethod;

    protected $guarded = ['id'];

    public const STATUS_INCOMPLETE = 'incomplete';
    public const STATUS_PENDING = 'pending';
    public const STATUS_RECEIVED = 'received';
    public const STATUS_CANCELLED = 'cancelled';

    public const ENV_PRODUCTION = 'production';
    public const ENV_SANDBOX = 'sandbox';

}
