<?php

namespace App\Models;

use App\Models\SalesOrder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SalesOrderItem extends Model
{
    protected $appends = ['short_desc'];

    public function salesOrder(): BelongsTo
    {
        return $this->belongsTo(SalesOrder::class);
    }

    protected function shortDesc(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->attributes['short_dec'] ?? null,
        );
    }
}
