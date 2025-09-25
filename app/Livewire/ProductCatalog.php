<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductCatalog extends Component
{
    public function render()
    {
        $products = Product::paginate(10);
        // TODO Make a DTO
        // 1. Clean Code (Data & Logic)
        // 2. Validation & Typing
        // 3. Fleksibel
        return view('livewire.product-catalog', compact('products'));
    }
}
