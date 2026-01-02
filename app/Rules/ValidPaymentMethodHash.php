<?php

declare(strict_types=1);

namespace App\Rules;

use Closure;
use App\Services\PaymentMethodQueryService;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidPaymentMethodHash implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $query = app(PaymentMethodQueryService::class);

        $found = $query->getPaymentMethodByHash($value);

        if (!$found) {
            $fail("The selected payment method is invalid");
        };
    }
}
