<?php

namespace App\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\Computed;

class SalesOrderItemData extends Data
{
    #[Computed]
    public string $price_formatted;
    #[Computed]
    public string $total_formatted;

    public function __construct(
        public string $name,
        public string $short_desc,
        public string $sku,
        public string $slug,
        public string $description,
        public string $cover_url,
        public int $quantity,
        public float $price,
        public float $total,
        public float $weight,
    ) {
        $this->price_formatted = number_format($this->price, 0, ',', '.');
        $this->total_formatted = number_format($this->total, 0, ',', '.');
    }
}
