<?php

namespace App\Livewire;

use App\Actions\ValidateCartStock;
use Livewire\Component;
use App\Contract\CartServiceInterface;
use League\Config\Exception\ValidationException;

class Cart extends Component
{
    public string $sub_total = '';
    public string $total = '';

    public function mount(CartServiceInterface $cart)
    {
        $all = $cart->all();

        $this->sub_total = $all->total_formatted;
        $this->total = $this->sub_total;
    }

    public function getItemsProperty(CartServiceInterface $cart)
    {
        return $cart->all()->items->toCollection();
    }

    public function checkout(CartServiceInterface $cart)
    {
        try {
            ValidateCartStock::run($cart);

            return redirect()->route('checkout');
        } catch (ValidationException $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->route('cart');
        }
    }

    public function render()
    {
        return view('livewire.cart', [
            'items' => $this->items,
        ]);
    }
}
