<?php

namespace App\Models\Traits\Relationship;

use App\Models\Contact;
use App\Models\Item;
use App\Models\ProductReport;
use App\Models\Serial;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use SebastianBergmann\CodeCoverage\Report\Xml\Report;

trait ProductReturnRelationship
{

    public function report(): HasOne
    {
        return $this->hasOne(ProductReport::class, 'productreturn_id')->withTrashed();
    }

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function serial(): BelongsTo
    {
        return $this->belongsTo(Serial::class, 'serial_id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function from(): BelongsTo
    {
        return $this->belongsTo(Contact::class, 'from_id');
    }

    public function to(): BelongsTo
    {
        return $this->belongsTo(Contact::class, 'to_id');
    }
}
