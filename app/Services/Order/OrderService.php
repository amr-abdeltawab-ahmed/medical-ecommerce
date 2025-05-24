<?php

namespace App\Services\Order;

use App\DTOs\OrderData;
use App\Models\Order;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Services\Cart\CartService;
use App\Exceptions\Cart\EmptyCartException;

class OrderService
{
    public function __construct(
        private readonly OrderRepositoryInterface $orderRepository,
        private readonly CartService $cartService
    ) {}

    public function paginate(int $perPage = 10)
    {
        return $this->orderRepository->paginate($perPage);
    }

    public function createFromCart(OrderData $orderData): Order
    {
        if ($this->cartService->isEmpty()) {
            throw new EmptyCartException();
        }

        $order = $this->orderRepository->create($orderData->toArray());
        $this->orderRepository->addItems($order, $this->cartService->toOrderItems());
        $this->cartService->clear();

        return $order;
    }

    public function findWithItems(int $orderId): ?Order
    {
        return $this->orderRepository->findWithItems($orderId);
    }
}
