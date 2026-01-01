<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Region;
use App\Data\RegionData;
use Spatie\LaravelData\DataCollection;

class RegionQueryService
{
    // Search regions by name, returning villages that match the keyword
    public function searchRegionByName(string $keyword, int $limit = 5): DataCollection
    {
        $regions = Region::where('type', 'village')
            ->where(function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('postal_code', 'like', '%' . $keyword . '%');
            })
            ->with(['parent.parent.parent']) // Eager load all parent relationships
            ->limit($limit)
            ->get()
            ->map(function ($region) {
                return RegionData::fromModel($region);
            })
            ->toArray();

        return new DataCollection(RegionData::class, $regions);
    }

    // Search region by code
    public function searchRegionByCode(string $code): ?RegionData
    {
        return RegionData::fromModel(
            Region::where('code', $code)->first()
        );
    }
}
