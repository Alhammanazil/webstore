<?php

declare(strict_types=1);

namespace App\Drivers\Payment;

use App\Data\PaymentData;
use App\Data\SalesOrderData;
use Spatie\LaravelData\DataCollection;
use App\Contract\PaymentDriverInterface;

class OfflinePaymentDriver implements PaymentDriverInterface
{
    public readonly string $driver;

    public function __construct()
    {
        $this->driver = 'offline';
    }

    /** @return DataCollection<PaymentData> */
    public function getMethods(): DataCollection
    {
        return PaymentData::collect([
            PaymentData::from([
                'driver' => $this->driver,
                'method' => 'bca-bank-transfer',
                'label' => 'BCA Bank Transfer',
                'payload' => [
                    'account_number' => '1234567890',
                    'account_holder_name' => 'Albert',
                ],
            ]),
        ], DataCollection::class);
    }

    public function process(SalesOrderData $sales_order)
    {
        // For offline payment, no processing is needed
        // Payment will be verified manually
        return true;
    }

    public function shouldShowPayNowButton( SalesOrderData $sales_order): bool
    {
        // Offline payment doesn't need a "Pay Now" button
        return false;
    }

    public function getRedirectUrl(SalesOrderData $sales_order): ?string
    {
        // Offline payment doesn't redirect anywhere
        return null;
    }
}
