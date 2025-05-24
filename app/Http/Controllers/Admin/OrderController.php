<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Order\OrderService;

class OrderController extends Controller
{
    public function __construct(
        protected OrderService $orderService
    ) {
    }

    public function index()
    {
        $orders = $this->orderService->paginate();
        return view('admin.orders.index', compact('orders'));
    }
}
