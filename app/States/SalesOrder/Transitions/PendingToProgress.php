<?php

declare(strict_types=1);

namespace App\States\SalesOrder\Transitions;

use App\Models\SalesOrder;
use App\States\SalesOrder\Progress;
use Spatie\ModelStates\Transition;

class PendingToProgress extends Transition
{
    private SalesOrder $salesOrder;

    public function __construct(SalesOrder $salesOrder)
    {
        $this->salesOrder = $salesOrder;
    }

    public function handle()
    {
        $this->salesOrder->update([
            'status' => Progress::class,
        ]);

        return $this->salesOrder;
    }
}
