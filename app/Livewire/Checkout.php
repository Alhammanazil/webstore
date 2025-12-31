<?php

namespace App\Livewire;

use App\Data\CartData;
use Livewire\Component;
use Illuminate\Support\Number;
use Illuminate\Support\Facades\Gate;
use App\Contract\CartServiceInterface;

class Checkout extends Component
{

    public array $data = [
        'full_name' => null,
        'email' => null,
        'phone_number' => null,
        'street_address' => null,
    ];

    public array $summaries = [
        'subtotal' => 0,
        'sub_total_formatted' => '-',
        'shipping_total' => 0,
        'shipping_total_formatted' => '-',
        'grand_total' => 0,
        'grand_total_formatted' => '-',
    ];

    public function mount()
    {
        if (!Gate::inspect('is_stock_avaliable')->allowed()) {
            return redirect()->route('cart');
        }
        $this->calculateTotal();
    }

    public function rules()
    {
        return [
            'data.full_name' => 'required|string|min:3|max:255',
            'data.email' => 'required|email|max:255',
            'data.phone_number' => 'required|regex:/^(\+?62)?[0-9]{7,13}$/|min:7|max:13',
            'data.street_address' => 'required|string|min:5|max:500',
        ];
    }

    public function calculateTotal()
    {
        // Set summary data
        data_set($this->summaries, 'subtotal', $this->cart->total);
        data_set($this->summaries, 'sub_total_formatted', Number::currency($this->cart->total));

        // For demonstration, shipping is set to 0
        $shipping_cost = 0;
        data_set($this->summaries, 'shipping_total', $shipping_cost);
        data_set($this->summaries, 'shipping_total_formatted', Number::currency($shipping_cost));

        // Grand total
        $grand_total = $this->cart->total + $shipping_cost;
        data_set($this->summaries, 'grand_total', $grand_total);
        data_set($this->summaries, 'grand_total_formatted', Number::currency($grand_total));
    }

    public function getCartProperty(CartServiceInterface $cart): CartData
    {
        return $cart->all();
    }

    public function placeAnOrder()
    {
        $this->validate();

        dd($this->data);
    }

    public function render()
    {
        return view('livewire.checkout', [
            'cart' => $this->cart,
            'summaries' => $this->summaries,
        ]);
    }
}
