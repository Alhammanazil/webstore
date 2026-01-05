<?php

declare(strict_types=1);

namespace App\States\SalesOrder\Transitions;

use App\Models\SalesOrder;
use App\Data\SalesOrderData;
use App\States\SalesOrder\Cancel;
use Spatie\ModelStates\Transition;
use App\States\SalesOrder\Progress;
use App\Events\SalesOrderCancelledEvent;

class PendingToCancel extends Transition
{
    public function __construct(
        private SalesOrder $sales_order
    ) {
        $this->sales_order = $sales_order;
    }

    public function handle()
    {
        $this->sales_order->update([
            'status' => Cancel::class,
        ]);

        event(new SalesOrderCancelledEvent(
            SalesOrderData::fromModel($this->sales_order)
        ));

        return $this->sales_order;
    }
}
