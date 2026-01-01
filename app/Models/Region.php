<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Region extends Model
{
    public $timestamps = false;

    public function parent() : BelongsTo
    {
        return $this->belongsTo(Region::class, 'parent_code', 'code');
    }

    public function children()
    {
        return $this->hasMany(Region::class, 'parent_code', 'code');
    }

    public function scopeProvince($query)
    {
        return $query->where('type', 'province');
    }

    public function scopeRegencies($query)
    {
        return $query->where('type', 'regencies');
    }

    public function scopeDistrict($query)
    {
        return $query->where('type', 'district');
    }

    public function scoreVillage($query)
    {
        return $query->where('type', 'village');
    }
}
