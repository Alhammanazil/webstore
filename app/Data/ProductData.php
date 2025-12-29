<?php

declare(strict_types=1);

namespace App\Data;

use App\Models\Product;
use Spatie\LaravelData\Data;
use Illuminate\Support\Number;
use Illuminate\Support\Optional;
use Livewire\Attributes\Computed;

class ProductData extends Data
{
    #[Computed]
    public string $price_formatted;

    public function __construct(
        public string $name,
        public string $short_desc,
        public string $sku,
        public string $slug,
        public ?string $description,
        public int $stock,
        public float $price,
        public ?float $weight,
        public string $cover_url,
        public Optional|array $gallery = new Optional([]),
    ) {
        $this->price_formatted = Number::currency($this->price);
    }

    public static function fromModel(Product $product, bool $with_gallery = false): self
    {
        return new self(
            name: $product->name,
            short_desc: $product->tags()->where('type', 'collection')->pluck('name')->join(', '),
            sku: $product->sku,
            slug: $product->slug,
            description: $product->description,
            stock: $product->stock,
            price: (float) $product->price,
            weight: $product->weight ? (float) $product->weight : null,
            cover_url: $product->getFirstMediaUrl('cover'),
            gallery: $with_gallery ? $product->getMedia('gallery')->map(fn($record) => $record->getUrl())->toArray() : new Optional([]),
        );
    }
}
