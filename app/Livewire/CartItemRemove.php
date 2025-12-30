<?php

namespace App\Livewire;

use Livewire\Component;
use App\Data\ProductData;
use App\Contract\CartServiceInterface;

class CartItemRemove extends Component
{

    public string $sku;
    public string $productName;
    public function mount(ProductData $product)
    {
        $this->sku = $product->sku;
        $this->productName = $product->name;
    }
    public function remove(CartServiceInterface $cart)
    {
        $cart->remove($this->sku);
        session()->flash('success', "Product {$this->productName} removed from cart.");
        $this->dispatch('cart-updated');
        return redirect()->route('cart');
    }
    public function render()
    {
        return view('livewire.cart-item-remove');
    }
}
