<?php

namespace App\Models;

use App\Observers\ProductReportObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy(ProductReportObserver::class)]
class ProductReport extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public const STATUS_PENDING = 'pending';
    public const STATUS_PROCESSING = 'processing';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_CANCELLED = 'cancelled';

    protected function casts(): array
    {
        return [
            'battery_key' => 'boolean',
            'antitheft_key' => 'boolean',
            'charger' => 'boolean',
            'battery' => 'boolean',
            'pedals' => 'boolean',
            'front_wheel' => 'boolean',
            'rear_wheel' => 'boolean',
            'saddle' => 'boolean',
            'seatpost' => 'boolean',
            'display' => 'boolean',
            'motor' => 'boolean',
            'stripes' => 'boolean',
            'corrosion' => 'boolean',
            'clay' => 'boolean',
            'sand' => 'boolean',
            'impacts' => 'boolean',
            'cracks' => 'boolean',
            'breakages' => 'boolean',
            'customizations' => 'boolean',
            'battery_charge' => 'boolean',
        ];
    }

    public function return(): BelongsTo
    {
        return $this->belongsTo(ProductReturn::class, 'product_return_id');
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            self::STATUS_PENDING => __('En attente'),
            self::STATUS_PROCESSING => __('En cours'),
            self::STATUS_COMPLETED => __('Terminé'),
            self::STATUS_CANCELLED => __('Annulé'),
            default => __('-'),
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            self::STATUS_PENDING => 'pending',
            self::STATUS_PROCESSING => 'processing',
            self::STATUS_COMPLETED => 'completed',
            self::STATUS_CANCELLED => 'cancelled',
            default => __('-'),
        };
    }
}
