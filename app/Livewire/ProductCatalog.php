<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Tag;
use App\Models\Product;
use Livewire\Component;
use App\Data\ProductData;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Data\ProductCollectionData;

class ProductCatalog extends Component
{
    use WithPagination;

    public $queryString = [
        'select_collections' => ['except' => []],
        'sort_by' => ['except' => 'latest'],
        'search' => ['except' => ''],
    ];

    public array $select_collections = [];

    public string $search = '';

    public string $sort_by = 'latest'; // latest, oldest, price_low_high, price_high_low

    public function mount()
    {
        $this->validate();
    }

    protected function rules()
    {
        return [
            'select_collections'    => 'array',
            'select_collections.*'  => 'integer|exists:tags,id',
            'search'                => 'nullable|string|min:3|max:30',
            'sort_by'               => 'in:latest,oldest,price_low_high,price_high_low',
        ];
    }

    public function updatedSearch($value)
    {
        $this->validateOnly('search');

        // Reset page hanya jika valid
        if (!$this->getErrorBag()->has('search')) {
            $this->resetPage();
        }
    }

    public function updatedSortBy()
    {
        $this->validateOnly('sort_by');
        $this->resetPage();
    }

    public function updatedSelectCollections()
    {
        $this->validateOnly('select_collections');
        $this->resetPage();
    }

    #[On('resetFilters')]
    public function applyFilters()
    {
        $this->validate();
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->select_collections = [];
        $this->sort_by = 'latest';
        $this->search = '';

        $this->resetErrorBag();
        $this->resetPage();
    }

    public function render()
    {
        //early return collection data
        if ($this->getErrorBag()->isNotEmpty()) {
            return view('livewire.product-catalog', [
                'products' => ProductData::collect([]),
                'collections' => ProductCollectionData::collect([]),
            ]);
        }

        $collection_result = Tag::query()->withType('collection')->get();

        // $result = Product::paginate(8);

        $query = Product::query();
        // Hanya lakukan search jika tidak ada error pada search field
        if ($this->search && !$this->getErrorBag()->has('search')) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        if (!empty($this->select_collections)) {
            $query->whereHas('tags', function ($q) {
                $q->whereIn('id', $this->select_collections);
            });
        }

        switch ($this->sort_by) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'price_low_high':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high_low':
                $query->orderBy('price', 'desc');
                break;
            case 'latest':
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
