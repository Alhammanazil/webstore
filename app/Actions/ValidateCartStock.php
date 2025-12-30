<?php

namespace App\Actions;

use App\Models\Product;
use App\Data\ProductData;
use App\Contract\CartServiceInterface;
use Lorisleiva\Actions\Concerns\AsAction;
use Illuminate\Validation\ValidationException;

class ValidateCartStock
{
    use AsAction;

    public function handle(CartServiceInterface $cart)
    {
        $insufficient = [];

        foreach ($cart->all()->items as $item) {
            /** @var ProductData $product */
            $product = $item->product();

            if (!$product || $product->stock < $item->quantity) {
                $insufficient[] = [
                    'sku' => $product->sku,
                    'name' => $product->name ?? 'Unknown Product',
                    'requested' => $item->quantity,
                    'available' => $product ? $product->stock : 0
                ];
            }
        }

        if ($insufficient) {
            throw ValidationException::withMessages([
                'cart' => 'Some Product is out of stock',
                'details' => $insufficient
            ]);
        }
    }
}
