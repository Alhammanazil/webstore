<?php

declare(strict_types=1);

namespace App\States\SalesOrder\Transitions;

use App\Models\SalesOrder;
use Spatie\ModelStates\Transition;
use App\States\SalesOrder\Progress;
use App\States\SalesOrder\Completed;

class ProgressToCompleted extends Transition
{
    private SalesOrder $salesOrder;

    public function __construct(SalesOrder $salesOrder)
    {
        $this->salesOrder = $salesOrder;
    }

    public function handle()
    {
        $this->salesOrder->update([
            'status' => Completed::class,
        ]);

        return $this->salesOrder;
    }
}
