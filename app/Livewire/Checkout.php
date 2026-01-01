<?php

namespace App\Livewire;

use App\Data\CartData;
use Livewire\Component;
use App\Data\RegionData;
use App\Data\ShippingData;
use Illuminate\Support\Number;
use App\Services\RegionQueryService;
use Illuminate\Support\Facades\Gate;
use App\Contract\CartServiceInterface;
use Spatie\LaravelData\DataCollection;
use App\Services\ShippingMethodService;
use Illuminate\Support\Enumerable;

class Checkout extends Component
{

    public array $data = [
        'full_name' => null,
        'email' => null,
        'phone_number' => null,
        'street_address' => null,
        'shipping_hash' => null,
    ];

    public array $region_selector = [
        'keyword' => null,
        'region_selected' => null,
    ];

    public array $shipping_selector = [
        'shipping_method' => null,
    ];

    public ?string $payment_method = null;

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
            'region_selector.region_selected' => 'required|array',
            'payment_method' => 'required|string',
            'data.shipping_hash' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'region_selector.region_selected.required' => 'Location must be selected',
            'data.full_name.required' => 'Full name is required',
            'data.full_name.min' => 'Full name must be at least 3 characters',
            'data.email.required' => 'Email is required',
            'data.email.email' => 'Email format is invalid',
            'data.phone_number.required' => 'Phone number is required',
            'data.phone_number.regex' => 'Phone number format is invalid',
            'data.street_address.required' => 'Street address is required',
            'data.street_address.min' => 'Street address must be at least 5 characters',
            'payment_method.required' => 'Payment method must be selected',
        ];
    }

    public function calculateTotal()
    {
        // Set summary data
        data_set($this->summaries, 'subtotal', $this->cart->total);
        data_set($this->summaries, 'sub_total_formatted', Number::currency($this->cart->total));

        // For demonstration, shipping is set to 0
        $shipping_cost = $this->shippingMethod?->cost ?? 0;
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

    public function getRegionsProperty(RegionQueryService $query_service): DataCollection
    {
        $keyword = data_get($this->region_selector, 'keyword');
        if (!$keyword) {
            return new DataCollection(RegionData::class, []);
        }

        return $query_service->searchRegionByName($keyword, 20);
    }

    /** @return DataCollection<ShippingData> */
    public function getShippingMethodsProperty(
        RegionQueryService $region_query,
        ShippingMethodService $shipping_service,
    ): DataCollection|Enumerable {
        if (!data_get($this->region_selector, 'region_selected.code')) {
            return new DataCollection(ShippingData::class, []);
        }

        $origin_code = config('shipping.shipping_origin_code');

        return $shipping_service->getShippingMethods(
            $region_query->searchRegionByCode($origin_code),
            $region_query->searchRegionByCode(data_get($this->region_selector, 'region_selected.code')),
            $this->cart,
        )->toCollection()->groupBy('service');
    }

    public function getShippingMethodProperty(ShippingMethodService $shipping_service): ?ShippingData
    {
        if (
            empty(data_get($this->data, 'shipping_hash')) ||
            empty(data_get($this->region_selector, 'region_selected.code'))
        ) {
            return null;
        }

        $data = $shipping_service->getShippingMethod(
            data_get($this->data, 'shipping_hash')
        );

        if ($data == null) {
            $this->addError('shipping_hash', 'Selected shipping method is invalid.');
            redirect()->route('checkout');
        }

        return $data;
    }

    public function updatedShippingSelectorShippingMethod($value)
    {
        data_set($this->data, 'shipping_hash', $value);
        $this->calculateTotal();
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
