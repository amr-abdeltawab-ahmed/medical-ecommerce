@extends('layouts.app')

@section('title', 'Order Successful')

@section('content')
<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <div class="text-center py-12">
            <svg class="mx-auto h-16 w-16 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 48 48">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 6L9 17l-5-5m36-3l-11 11-5-5M20 36l-11-11-5 5m36-3l-11 11-5-5"/>
            </svg>

            <h2 class="mt-4 text-3xl font-bold text-gray-900 dark:text-white">Order Successful!</h2>
            <p class="mt-2 text-lg text-gray-600 dark:text-gray-300">Thank you for your order. Your order number is #{{ $order->id }}</p>

            <div class="mt-8 bg-gray-50 dark:bg-gray-700 p-6 rounded-lg max-w-2xl mx-auto text-left">
                <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Order Details</h3>
                
                <div class="space-y-4">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Delivery To</p>
                        <p class="font-medium text-gray-900 dark:text-white">{{ $order->name }}</p>
                        <p class="text-gray-600 dark:text-gray-300">{{ $order->address }}</p>
                        <p class="text-gray-600 dark:text-gray-300">{{ $order->phone }}</p>
                    </div>

                    <div class="border-t border-gray-200 dark:border-gray-600 pt-4">
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Order Items</p>
                        @foreach($order->items as $item)
                            <div class="flex justify-between py-2">
                                <div>
                                    <p class="font-medium text-gray-900 dark:text-white">{{ $item->product->name }}</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-300">Quantity: {{ $item->quantity }}</p>
                                </div>
                                <p class="font-medium text-gray-900 dark:text-white">${{ number_format($item->price * $item->quantity, 2) }}</p>
                            </div>
                        @endforeach
                    </div>

                    <div class="border-t border-gray-200 dark:border-gray-600 pt-4">
                        <div class="flex justify-between font-bold">
                            <span class="text-gray-900 dark:text-white">Total</span>
                            <span class="text-gray-900 dark:text-white">${{ number_format($order->total, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8">
                <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 dark:bg-blue-500 text-white rounded-md hover:bg-blue-700 dark:hover:bg-blue-600">
                    Continue Shopping
                </a>
            </div>
        </div>
    </div>
</div>
@endsection 