<?php

declare(strict_types=1);

namespace App\Drivers\Shipping;

use Log;
use App\Data\CartData;
use App\Data\RegionData;
use App\Data\ShippingData;
use App\Data\ShippingServiceData;
use Illuminate\Support\Facades\Http;
use Spatie\LaravelData\DataCollection;
use App\Contract\ShippingDriverInterface;

class APIKurirShippingDriver implements ShippingDriverInterface
{
    public readonly string $driver;
    public function __construct()
    {
        $this->driver = 'apikurir';
    }

    /** @return DataCollection<ShippingServiceData> */
    public function getServices(): DataCollection
    {
        return ShippingServiceData::collect(
            [
                [
                    'driver' => $this->driver,
                    'code' => 'jne-reguler',
                    'courier' => 'JNE',
                    'service' => 'Regular',
                ],
                [
                    'driver' => $this->driver,
                    'code' => 'jne-sameday',
                    'courier' => 'JNE',
                    'service' => 'Same Day',
                ],
                [
                    'driver' => $this->driver,
                    'code' => 'ninja-xpress-regular',
                    'courier' => 'Ninja Xpress',
                    'service' => 'Regular',
                ],
            ],
            DataCollection::class
        );
    }

    public function getRate(
        RegionData $origin,
        RegionData $destination,
        CartData $cart,
        ShippingServiceData $shipping_service,
    ): ?ShippingData {
        try {
            $response = Http::withBasicAuth(
                config('shipping.api-kurir.username'),
                config('shipping.api-kurir.password')
            )
                ->timeout(10) // 10 seconds timeout untuk API external
                ->connectTimeout(10) // Timeout untuk koneksi awal
                ->post('https://sandbox.apikurir.id/shipments/v1/open-api/rates', [
                    'isUseInsurance' => true,
                    'isPickup' => true,
                    'isCod' => false,
                    'dimensions' => [10, 10, 10], // Required: panjang, lebar, tinggi dalam cm
                    'weight' => $cart->total_weight,
                    'packagePrice' => $cart->total,
                    'origin' => [
                        'postalCode' => $origin->postal_code,
                    ],
                    'destination' => [
                        'postalCode' => $destination->postal_code,
                    ],
                    'logistics' => [$shipping_service->courier],
                    'services' => [$shipping_service->service],
                ]);

            // Log untuk debugging
            // \Log::info('APIKurir Response', [
            //     'status' => $response->status(),
            //     'body' => $response->json(),
            // ]);

            // Check if the response was successful
            if (!$response->successful()) {
                return null;
            }

            $data = $response->collect('data')->flatten(1)->values()->first();
            if (empty($data)) {
                return null;
            }

            $est = data_get($data, 'minDuration') . '-' . data_get($data, 'maxDuration') . data_get($data, 'durationType');
            return new ShippingData(
                $this->driver,
                $shipping_service->courier,
                $shipping_service->service,
                $est,
                data_get($data, 'price'),
                data_get($data, 'weight'),
                $origin,
                $destination,
                data_get($data, 'logoUrl'),
            );
        } catch (\Exception $e) {
            // Log the error untuk debugging
            // Log::error('APIKurir Shipping Driver Error', [
            //     'message' => $e->getMessage(),
            //     'code' => $e->getCode(),
            //     'service' => $shipping_service->code,
            //     'origin' => $origin->postal_code,
            //     'destination' => $destination->postal_code,
            // ]);

            // Return null to skip this shipping method
            return null;
        }
    }
}
