<?php

namespace App\Livewire;

use App\Data\SalesOrderData;
use Livewire\Component;
use App\Models\SalesOrder;
use App\Services\PaymentMethodQueryService;

class SalesOrderDetail extends Component
{
    public ?SalesOrder $sales_order = null;
    public ?string $trx_id = null;

    public function mount(?string $trx_id = null)
    {
        if ($trx_id) {
            $this->trx_id = $trx_id;
            $this->sales_order = SalesOrder::where('trx_id', $trx_id)->first();
        }
    }

    public function render()
    {
        if (!$this->sales_order) {
            return view('livewire.sales-order-detail', [
                'order' => null,
                'is_redirected' => false,
                'redirect_url' => null,
            ]);
        }

        $service = app(PaymentMethodQueryService::class);
        $sales_order_data = SalesOrderData::fromModel($this->sales_order);
        return view('livewire.sales-order-detail', [
            'order' => $sales_order_data,
            'is_redirected' => $service->shouldShowButton($sales_order_data),
            'redirect_url' => $service->getRedirectUrl($sales_order_data),
        ]);
    }
}
