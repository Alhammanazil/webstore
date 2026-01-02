<?php

namespace App\Data;

use Nette\Utils\Json;
use Spatie\LaravelData\Data;

class PaymentData extends Data
{
    public string $hash;

    public function __construct(
        public string $driver,
        public string $method,
        public string $label,
        public array $payload = [],
    ) {
        $this->hash = md5("{$this->driver}{$this->method}|" . json_encode($payload));
    }
}
