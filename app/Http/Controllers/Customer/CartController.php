<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\UpdateCartItemRequest;
use App\Models\Product;
use App\Services\Cart\CartService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CartController extends Controller
{
    public function __construct(
        protected CartService $cartService
    ) {}

    public function index(): View
    {
        $cart = $this->cartService->get();
        $total = $this->cartService->total();

        return view('customer.cart', compact('cart', 'total'));
    }

    public function add(Product $product): RedirectResponse
    {
        $this->cartService->add($product);

        return back()->with('success', 'Product added to cart.');
    }

    public function update(UpdateCartItemRequest $request): RedirectResponse
    {
        foreach ($request->input('quantities') as $productId => $quantity) {
            $this->cartService->update((int) $productId, (int) $quantity);
        }

        return redirect()->route('cart')->with('success', 'Cart updated successfully.');
    }

    public function remove(int $productId): RedirectResponse
    {
        $this->cartService->remove($productId);

        return redirect()->route('cart')->with('success', 'Product removed from cart.');
    }
}
