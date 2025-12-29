<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Product;
use App\Models\Tag;
use Livewire\Component;
use App\Data\ProductData;
use App\Data\ProductCollectionData;
use Livewire\WithPagination;

class ProductCatalog extends Component
{
    use WithPagination;

    public $queryString = [
        'select_collections' => ['except' => []],
        'sort_by' => ['except' => 'newest'],
        'search' => ['except' => ''],
    ];

    public array $select_collections = [];

    public string $search = '';

    public string $sort_by = 'newest'; // latest, price_asc, price_desc

    public function applyFilters()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->select_collections = [];
        $this->sort_by = 'newest';
        $this->search = '';
        $this->resetPage();
    }

    public function render()
    {
        $collection_result = Tag::query()->withType('collection')->get();

        // $result = Product::paginate(8);

        $query = Product::query();
        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        if (!empty($this->select_collections)) {
            $query->whereHas('tags', function ($q) {
                $q->whereIn('id', $this->select_collections);
            });
        }

        switch ($this->sort_by) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'newest':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $products = ProductData::collect(
            $query->paginate(9)
        );
        $collections = ProductCollectionData::collect($collection_result);

        return view('livewire.product-catalog', compact('products', 'collections'));
    }
}
