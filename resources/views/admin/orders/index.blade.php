@extends('layouts.app')

@section('title', 'Orders Management')

@section('content')
    <div class="container mx-auto px-4 py-8 max-w-6xl mt-10">
        <h2 class="text-4xl font-bold text-gray-800 dark:text-white mb-8">📦 All Orders</h2>

        @forelse ($orders as $order)
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 mb-8 shadow-lg transition hover:shadow-xl">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        🧾 Order #{{ $order->id }}
                    </h3>
                    <span class="text-sm text-gray-500 dark:text-gray-400">
                        Placed: {{ $order->created_at->format('M d, Y h:i A') }}
                    </span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm text-gray-700 dark:text-gray-300 mb-4">
                    <div>
                        <strong>👤 Customer:</strong> {{ $order->customer_name }}<br>
                        <strong>📞 Phone:</strong> {{ $order->customer_phone }}
                    </div>
                    <div>
                        <strong>📍 Address:</strong><br>
                        {{ $order->delivery_address }}
                    </div>
                </div>

                <div class="mt-4">
                    <h4 class="text-md font-semibold text-gray-800 dark:text-white mb-2">🧺 Items Ordered:</h4>
                    <ul class="list-disc list-inside space-y-1 text-gray-700 dark:text-gray-300">
                        @foreach ($order->items as $item)
                            <li>{{ $item->product->name }} × {{ $item->quantity }} – ${{ $item->price }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @empty
            <div class="text-center py-12">
                <div class="text-gray-400 dark:text-gray-500 mb-4">
                    <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9.75 9.75h.008v.008H9.75V9.75zm4.5 0h.008v.008H14.25V9.75zm-6 3h.008v.008H8.25V12.75zm7.5 0h.008v.008H15.75V12.75zM9 16.5h6M12 3a9 9 0 100 18 9 9 0 000-18z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-medium text-gray-900 dark:text-white mb-2">No Orders Found</h3>
                <p class="text-gray-500 dark:text-gray-400">Customers haven't placed any orders yet.</p>
            </div>
        @endforelse
    </div>
@endsection
