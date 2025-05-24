<?php

namespace App\Services\Cart;

use App\DTOs\CartItem;
use App\Models\Product;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Collection;

class CartService
{
    private const CART_KEY = 'cart';

    public function __construct(
        private readonly SessionManager $session
    ) {}

    public function get(): Collection
    {
        $this->ensureCartInitialized();
        $items = collect($this->session->get(self::CART_KEY));

        return $items->map(function ($item, $productId) {
            return new CartItem(
                productId: $productId,
                name: $item['name'],
                price: $item['price'],
                quantity: $item['quantity'],
                image: $item['image']
            );
        });
    }

    public function add(Product $product, int $quantity = 1): void
    {
        $cart = $this->getRawCart();
        $existingQuantity = $cart->get($product->id)['quantity'] ?? 0;

        $cartItem = CartItem::fromProduct($product, $existingQuantity + $quantity);
        $cart[$product->id] = $cartItem->toArray();

        $this->updateRaw($cart);
    }

    public function update(int $productId, int $quantity): void
    {
        $cart = $this->getRawCart();

        if (!$cart->has($productId)) {
            throw new \InvalidArgumentException('Product not found in cart');
        }

        $item = new CartItem(
            productId: $productId,
            name: $cart[$productId]['name'],
            price: $cart[$productId]['price'],
            quantity: $quantity,
            image: $cart[$productId]['image']
        );

        $cart[$productId] = $item->toArray();
        $this->updateRaw($cart);
    }

    public function remove(int $productId): void
    {
        $cart = $this->getRawCart();

        if (!$cart->has($productId)) {
            throw new \InvalidArgumentException('Product not found in cart');
        }

        $cart->forget($productId);

        if ($cart->isEmpty()) {
            $this->clear();
        } else {
            $this->updateRaw($cart);
        }
    }

    public function clear(): void
    {
        $this->session->forget(self::CART_KEY);
    }

    public function isEmpty(): bool
    {
        return $this->getRawCart()->isEmpty();
    }

    public function total(): float
    {
        return $this->get()->sum(function (CartItem $item) {
            return $item->total();
        });
    }

    public function toOrderItems(): array
    {
        return $this->get()
            ->map(fn(CartItem $item) => $item->toOrderItem())
            ->values()
            ->all();
    }

    private function getRawCart(): Collection
    {
        $this->ensureCartInitialized();
        return collect($this->session->get(self::CART_KEY));
    }

    private function ensureCartInitialized(): void
    {
        if (!$this->session->has(self::CART_KEY)) {
            $this->session->put(self::CART_KEY, []);
        }
    }

    private function updateRaw(Collection $cart): void
    {
        $this->session->put(self::CART_KEY, $cart->all());
    }
}
