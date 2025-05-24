@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h2 class="text-2xl font-bold mb-4 text-green-700">Order Confirmed!</h2>

        <p class="text-gray-700 dark:text-gray-300 mb-4">Thank you, <strong>{{ $order->customer_name }}</strong>!</p>

        <div class="bg-white dark:bg-gray-800 p-4 rounded shadow">
            <h3 class="text-lg font-semibold mb-2 text-gray-800 dark:text-white">Order Summary</h3>
            <ul class="list-disc list-inside text-gray-600 dark:text-gray-300">
                @foreach ($order->items as $item)
                    <li>{{ $item->product->name }} × {{ $item->quantity }} — ${{ $item->price * $item->quantity }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
