<?php

namespace App\DTOs;

use Illuminate\Support\Collection;

class OrderData
{
    public function __construct(
        public readonly string $customerName,
        public readonly string $customerPhone,
        public readonly string $deliveryAddress,
        public readonly Collection $cartItems // <-- NEW
    ) {}

    public static function fromRequest(array $data, Collection $cartItems): self
    {
        return new self(
            customerName: $data['name'],
            customerPhone: $data['phone'],
            deliveryAddress: $data['address'],
            cartItems: $cartItems
        );
    }

    public function toArray(): array
    {
        return [
            'customer_name' => $this->customerName,
            'customer_phone' => $this->customerPhone,
            'delivery_address' => $this->deliveryAddress,
        ];
    }
}
