<?php

namespace App\DTOs;

use App\Models\Product;

class CartItem
{
    public function __construct(
        public readonly int $productId,
        public readonly string $name,
        public readonly float $price,
        public readonly int $quantity,
        public readonly ?string $image = null
    ) {}

    public static function fromProduct(Product $product, int $quantity = 1): self
    {
        return new self(
            productId: $product->id,
            name: $product->name,
            price: $product->price,
            quantity: $quantity,
            image: $product->image
        );
    }

    public function incrementQuantity(int $amount = 1): self
    {
        return new self(
            productId: $this->productId,
            name: $this->name,
            price: $this->price,
            quantity: $this->quantity + $amount,
            image: $this->image
        );
    }

    public function updateQuantity(int $quantity): self
    {
        return new self(
            productId: $this->productId,
            name: $this->name,
            price: $this->price,
            quantity: max(1, $quantity),
            image: $this->image
        );
    }

    public function total(): float
    {
        return $this->price * $this->quantity;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'image' => $this->image,
        ];
    }

    public function toOrderItem(): array
    {
        return [
            'product_id' => $this->productId,
            'quantity' => $this->quantity,
            'price' => $this->price,
        ];
    }
}
