<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class ProductData extends Data
{
    public function __construct(
        public string $name,
        public string $sku,
        public string $slug,
        public ?string $description,
        public int $stock,
        public float $price,
        public ?float $weight,
    ) {}
}
