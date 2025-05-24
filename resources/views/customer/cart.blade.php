@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <h2 class="text-2xl font-bold mb-4 text-gray-900 dark:text-white">Shopping Cart</h2>

        @if($cart->isEmpty())
            <div class="text-center py-8">
                <p class="text-gray-500 dark:text-gray-400 mb-4">Your cart is empty</p>
                <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 dark:bg-blue-500 text-white rounded-md hover:bg-blue-700 dark:hover:bg-blue-600">
                    Continue Shopping
                </a>
            </div>
        @else
            <form action="{{ route('cart.update') }}" method="POST" class="space-y-4">
                @csrf
                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($cart as $item)
                        <div class="flex items-center justify-between py-4">
                            <div class="flex items-center space-x-4">
                                @if($item->image)
                                    <img src="{{ Storage::url($item->image) }}" 
                                         alt="{{ $item->name }}" 
                                         class="w-16 h-16 object-cover rounded">
                                @else
                                    <div class="w-16 h-16 bg-gray-200 dark:bg-gray-700 rounded flex items-center justify-center">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                                <div>
                                    <h3 class="font-semibold text-gray-900 dark:text-white">{{ $item->name }}</h3>
                                    <p class="text-gray-600 dark:text-gray-300">${{ number_format($item->price, 2) }}</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <div class="flex items-center space-x-2">
                                    <label for="quantity-{{ $item->productId }}" class="sr-only">Quantity</label>
                                    <input type="number" 
                                           id="quantity-{{ $item->productId }}"
                                           name="quantities[{{ $item->productId }}]" 
                                           value="{{ $item->quantity }}"
                                           min="1"
                                           class="w-20 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>
                                
                                <button type="button" 
                                        onclick="document.getElementById('remove-form-{{ $item->productId }}').submit()"
                                        class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6 flex items-center justify-between">
                    <div>
                        <span class="text-lg font-semibold text-gray-900 dark:text-white">Total:</span>
                        <span class="text-2xl font-bold ml-2 text-gray-900 dark:text-white">${{ number_format($total, 2) }}</span>
                    </div>
                    <div class="space-x-4">
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-700 text-white rounded-md hover:bg-gray-700 dark:hover:bg-gray-600">
                            Update Cart
                        </button>
                        <a href="{{ route('checkout') }}" 
                           class="inline-flex items-center px-4 py-2 bg-blue-600 dark:bg-blue-500 text-white rounded-md hover:bg-blue-700 dark:hover:bg-blue-600">
                            Proceed to Checkout
                        </a>
                    </div>
                </div>
            </form>

            @foreach($cart as $item)
                <form id="remove-form-{{ $item->productId }}" 
                      action="{{ route('cart.remove', $item->productId) }}" 
                      method="POST" 
                      class="hidden">
                    @csrf
                </form>
            @endforeach
        @endif
    </div>
</div>
@endsection
