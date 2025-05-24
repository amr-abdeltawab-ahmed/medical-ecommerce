<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <img src="{{ $product->imageUrl() }}" 
         alt="{{ $product->name() }}" 
         class="w-full h-48 object-cover">
    
    <div class="p-4">
        <h3 class="text-lg font-semibold">{{ $product->name() }}</h3>
        <p class="text-gray-600 text-sm mt-1">{{ $product->description() }}</p>
        
        <div class="mt-2 flex items-center justify-between">
            <span class="text-lg font-bold">${{ $product->formattedPrice() }}</span>
            <span class="{{ $product->stockStatusClass() }}">
                {{ $product->stockStatus() }}
            </span>
        </div>

        @if($showAddToCart && $product->inStock())
            <form action="{{ route('cart.add', $product->id()) }}" method="POST" class="mt-4">
                @csrf
                <button type="submit" 
                        class="w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition">
                    Add to Cart
                </button>
            </form>
        @endif
    </div>
</div> 