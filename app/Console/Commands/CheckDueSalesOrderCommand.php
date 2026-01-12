<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\SalesOrder;
use Illuminate\Console\Command;
use App\States\SalesOrder\Pending;
use Filament\Support\Exceptions\Cancel;

class CheckDueSalesOrderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sales-order:check-due';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for due sales orders';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now()->startOfMinute();

        $due_orders = SalesOrder::where('due_date_at', '<=', $now)
            ->where('status', Pending::class)
            ->get()->each(function (SalesOrder $sales_order) {
                $this->info("Due Date Found : #{$sales_order->trx_id}");

                $sales_order->status->transitionTo(Cancel::class);
            });

        return Command::SUCCESS;
    }
}
