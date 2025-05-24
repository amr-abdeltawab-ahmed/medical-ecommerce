@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <h2 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">Checkout</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Order Summary -->
            <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Order Summary</h3>
                <div class="space-y-4">
                    @foreach($cart as $item)
                        <div class="flex justify-between">
                            <div>
                                <h4 class="font-medium text-gray-900 dark:text-white">{{ $item->name }}</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-300">Quantity: {{ $item->quantity }}</p>
                            </div>
                            <p class="font-medium text-gray-900 dark:text-white">${{ number_format($item->price * $item->quantity, 2) }}</p>
                        </div>
                    @endforeach

                    <div class="border-t border-gray-200 dark:border-gray-600 pt-4 mt-4">
                        <div class="flex justify-between font-bold">
                            <span class="text-gray-900 dark:text-white">Total</span>
                            <span class="text-gray-900 dark:text-white">${{ number_format($total, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Checkout Form -->
            <div>
                <form action="{{ route('checkout.submit') }}" method="POST">
                    @csrf

                    <div class="space-y-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Full Name</label>
                            <input type="text" 
                                   name="name" 
                                   id="name" 
                                   value="{{ old('name') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                   required>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone Number</label>
                            <input type="tel" 
                                   name="phone" 
                                   id="phone" 
                                   value="{{ old('phone') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                   required>
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Delivery Address</label>
                            <textarea name="address" 
                                      id="address" 
                                      rows="3"
                                      class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                      required>{{ old('address') }}</textarea>
                            @error('address')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end space-x-4">
                            <a href="{{ route('cart') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-700 text-white rounded-md hover:bg-gray-700 dark:hover:bg-gray-600">
                                Back to Cart
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 dark:bg-blue-500 text-white rounded-md hover:bg-blue-700 dark:hover:bg-blue-600">
                                Place Order
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
