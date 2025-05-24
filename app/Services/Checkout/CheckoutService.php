<?php

namespace App\Services\Checkout;

use App\DTOs\OrderData;
use App\Models\Order;
use App\Services\Order\OrderService;
use App\Services\Cart\CartService;

class CheckoutService
{
    public function __construct(
        protected OrderService $orderService,
        protected CartService $cartService
    ) {}

    public function processCheckout(string $name, string $phone, string $address): Order
    {
        $orderData = new OrderData(
            customerName: $name,
            customerPhone: $phone,
            deliveryAddress: $address,
            cartItems: $this->cartService->get()
        );

        return $this->orderService->createFromCart($orderData);
    }

    public function getCart()
    {
        return $this->cartService->get();
    }

    public function getCartTotal(): float
    {
        return $this->cartService->total();
    }
}
