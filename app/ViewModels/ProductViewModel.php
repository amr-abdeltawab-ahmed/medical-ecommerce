<?php

namespace App\ViewModels;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductViewModel
{
    public function __construct(
        private readonly Product $product
    ) {}

    public function id(): int
    {
        return $this->product->id;
    }

    public function name(): string
    {
        return $this->product->name;
    }

    public function description(): string
    {
        return $this->product->description;
    }

    public function price(): float
    {
        return $this->product->price;
    }

    public function formattedPrice(): string
    {
        return number_format($this->product->price, 2);
    }

    public function imageUrl(): string
    {
        return $this->product->image
            ? Storage::url($this->product->image)
            : '/images/placeholder.png';
    }

    public function inStock(): bool
    {
        return $this->product->quantity > 0;
    }

    public function stockStatus(): string
    {
        if ($this->product->quantity > 10) {
            return 'In Stock';
        }

        if ($this->product->quantity > 0) {
            return 'Low Stock';
        }

        return 'Out of Stock';
    }

    public function stockStatusClass(): string
    {
        return match(true) {
            $this->product->quantity > 10 => 'text-green-600',
            $this->product->quantity > 0 => 'text-yellow-600',
            default => 'text-red-600',
        };
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id(),
            'name' => $this->name(),
            'description' => $this->description(),
            'price' => $this->price(),
            'formatted_price' => $this->formattedPrice(),
            'image_url' => $this->imageUrl(),
            'in_stock' => $this->inStock(),
            'stock_status' => $this->stockStatus(),
            'stock_status_class' => $this->stockStatusClass(),
        ];
    }
} 