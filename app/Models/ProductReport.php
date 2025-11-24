<?php

namespace App\Models;

use App\Models\Traits\Method\ProductReportMethod;
use App\Models\Traits\Relationship\ProductReportRelationship;
use App\Models\Traits\Scope\ProductReportScope;
use App\Observers\ProductReportObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\Attribute\ProductReportAttribute;

#[ObservedBy(ProductReportObserver::class)]
class ProductReport extends Model
{
    use SoftDeletes,
        ProductReportAttribute,
        ProductReportMethod,
        ProductReportScope,
        ProductReportRelationship;

    protected $table = 'productreports';

    protected $guarded = ['id'];

    protected function casts()
    {
        return [
            'battery_look_states' => 'array',
            'started_at' => 'datetime',
            'closed_at' => 'datetime',
            'bms_state' => 'boolean',
        ];
    }
    public const STATUS_INIT = 'init';

    public const STATUS_PENDING = 'pending';
    public const STATUS_IN_PROGRESS = 'in_progress';
    public const STATUS_PAUSED = 'paused';
    public const STATUS_CLOSED = 'closed';
    public const STATUS_CANCELLED = 'cancelled';

}
