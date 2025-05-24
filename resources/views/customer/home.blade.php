@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8 max-w-6xl mt-10">
        {{-- Header + Search + Cart --}}
        <div class="flex flex-col sm:flex-row justify-between items-center mb-12 gap-4">
            <h2 class="text-5xl font-bold text-gray-800 dark:text-white mt-2">🩺 Medical Products</h2>

            <div class="flex items-center gap-4">
                <div class="relative">
                    <input type="text"
                           id="search"
                           placeholder="Search products..."
                           class="w-64 px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                </div>
                <a href="{{ route('cart') }}"
                   class="inline-flex items-center gap-2 bg-green-600 text-white px-5 py-2.5 rounded-lg hover:bg-green-700 transition shadow">
                    <span>🛒</span>
                    <span>View Cart</span>
                </a>
            </div>
        </div>

        {{-- Product Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach ($products as $product)
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 hover:shadow-xl transition-all duration-300 overflow-hidden group">
                    {{-- Product Image --}}
                    <div class="relative bg-gray-100 dark:bg-gray-700 overflow-hidden rounded-t-xl flex items-center justify-center"
                         style="width: 100%; height: 260px;">
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}"
                                 alt="{{ $product->name }}"
                                 class="max-w-full max-h-full object-contain group-hover:scale-105 transition-transform duration-300">
                        @else
                            <div class="flex items-center justify-center h-full text-gray-400 dark:text-gray-500">
                                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                    </div>

                    {{-- Product Info --}}
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ $product->name }}</h3>

                        @if($product->description)
                            <p class="text-gray-600 dark:text-gray-300 text-sm mb-2 line-clamp-2">
                                {{ $product->description }}
                            </p>
                        @endif

                        @if($product->category)
                            <span class="inline-block mb-4 px-3 py-1 bg-blue-500 text-white text-sm rounded-full shadow-md">
                                {{ $product->category }}
                            </span>
                        @endif

                        <div class="flex items-center justify-between">
                            <span class="text-2xl font-bold text-gray-900 dark:text-white">
                                ${{ number_format($product->price, 2) }}
                            </span>

                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                        class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    <span>Add to Cart</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Empty State --}}
        @if($products->isEmpty())
            <div class="text-center py-12">
                <div class="text-gray-400 dark:text-gray-500 mb-4">
                    <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                </div>
                <h3 class="text-xl font-medium text-gray-900 dark:text-white mb-2">No Products Available</h3>
                <p class="text-gray-500 dark:text-gray-400">Check back later for new products.</p>
            </div>
        @endif
    </div>

    {{-- Simple Search Script --}}
    <script>
        document.getElementById('search').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const products = document.querySelectorAll('.grid > div');

            products.forEach(product => {
                const name = product.querySelector('h3').textContent.toLowerCase();
                const description = product.querySelector('p')?.textContent.toLowerCase() || '';
                const category = product.querySelector('span.bg-blue-500')?.textContent.toLowerCase() || '';

                if (name.includes(searchTerm) || description.includes(searchTerm) || category.includes(searchTerm)) {
                    product.style.display = '';
                } else {
                    product.style.display = 'none';
                }
            });
        });
    </script>
@endsection
