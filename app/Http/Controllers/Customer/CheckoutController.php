<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

use App\Http\Requests\CheckoutRequest;
use App\Services\Checkout\CheckoutService;

class CheckoutController extends Controller
{
    public function __construct(
        protected CheckoutService $checkoutService
    ) {}

    public function index(): View
    {
        $cart = $this->checkoutService->getCart();
        $total = $this->checkoutService->getCartTotal();

        return view('customer.checkout', compact('cart', 'total'));
    }


    public function store(CheckoutRequest $request): RedirectResponse
    {
        $order = $this->checkoutService->processCheckout(
            $request->input('name'),
            $request->input('phone'),
            $request->input('address')
        );

        return redirect()->route('confirmation', $order)->with('success', 'Order placed successfully.');
    }

    public function success(Order $order): View
    {
        return view('customer.order-success', compact('order'));
    }
}
