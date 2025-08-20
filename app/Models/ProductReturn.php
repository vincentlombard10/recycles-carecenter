<?php

namespace App\Models;

use App\Models\Traits\Attributes\ProductReturnAttributes;
use App\Models\Traits\Relationship\ProductReturnRelationship;
use App\Observers\ProductReturnObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy(ProductReturnObserver::class)]
class ProductReturn extends Model
{
    use SoftDeletes,
        ProductReturnAttributes,
        ProductReturnRelationship;

    protected $guarded = ['id'];

    public const STATUS_PENDING = 'pending';
    public const STATUS_RECEIVED = 'received';
    public const STATUS_FIRST_QUOTATION = 'first_quotation';
    public const STATUS_FIRST_QUOTATION_REMINDER = 'first_quotation_reminder';
    public const STATUS_FIRST_QUOTATION_APPROVED = 'first_quotation_approved';
    public const STATUS_FIRST_QUOTATION_REJECTED = 'first_quotation_rejected';
    public const STATUS_SECOND_QUOTATION = 'second_quotation';
    public const STATUS_SECOND_QUOTATION_REMINDER = 'second_quotation_reminder';
    public const STATUS_SECOND_QUOTATION_APPROVED = 'second_quotation_approved';
    public const STATUS_SECOND_QUOTATION_REJECTED = 'second_quotation_rejected';
    public const STATUS_SHIPPED = 'shipped';
    public const STATUS_FINISHED = 'process_finished';
    public const STATUS_CANCELLED = 'cancelled';

    public function reshippedTo(): BelongsTo
    {
        return $this->belongsTo(Contact::class, 'reshipment_id');
    }

    public function ofTypeComponent(): bool
    {
        return match ($this->type) {
            'composant', 'component', 'c', 'C', 'part' => true,
            default => false
        };
    }

    public function ofTypeBike(): bool
    {
        return match ($this->type) {
            'velo', 'bike', 'B', 'b' => true,
            default => false
        };
    }
}
