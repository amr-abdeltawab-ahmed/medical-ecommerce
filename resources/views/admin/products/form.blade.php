@csrf
<div class="max-w-2xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-lg shadow">
    {{-- Name --}}
    <div class="mb-6">
        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Product Name</label>
        <input type="text"
               name="name"
               id="name"
               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white"
               value="{{ old('name', $product->name ?? '') }}"
               required>
    </div>

    {{-- Description --}}
    <div class="mb-6">
        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Description</label>
        <textarea name="description"
                  id="description"
                  rows="4"
                  class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white">{{ old('description', $product->description ?? '') }}</textarea>
    </div>

    {{-- Price --}}
    <div class="mb-6">
        <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Price ($)</label>
        <input type="number"
               step="0.01"
               name="price"
               id="price"
               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white"
               value="{{ old('price', $product->price ?? '') }}"
               required>
    </div>

    {{-- Category --}}
    <div class="mb-6">
        <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Category</label>
        <input type="text"
               name="category"
               id="category"
               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white"
               value="{{ old('category', $product->category ?? '') }}">
    </div>

    {{-- Image Upload --}}
    <div class="mb-6">
        <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Product Image</label>
        <div class="mt-1 flex items-center">
            <div class="w-full">
                <input type="file"
                       name="image"
                       id="image"
                       accept="image/*"
                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white"
                       onchange="previewImage(event)">
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Recommended size: 800x600px. Max file size: 2MB
                </p>
            </div>
        </div>

        {{-- Image Preview --}}
        <div class="mt-4">
            <div id="imagePreview" class="hidden mt-2">
                <img src="#" alt="Preview" class="max-w-xs rounded-lg shadow-sm">
            </div>
            @if(isset($product) && $product->image)
                <div class="mt-2">
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">Current Image:</p>
                    <img src="{{ asset('storage/' . $product->image) }}"
                         alt="{{ $product->name }}"
                         class="max-w-xs rounded-lg shadow-sm">
                </div>
            @endif
        </div>
    </div>

    {{-- Submit Button --}}
    <div class="flex justify-end">
        <button type="submit"
                class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
            Save Product
        </button>
    </div>
</div>

{{-- Image Preview Script --}}
<script>
function previewImage(event) {
    const preview = document.getElementById('imagePreview');
    const image = preview.querySelector('img');
    const file = event.target.files[0];

    if (file) {
        image.src = URL.createObjectURL(file);
        preview.classList.remove('hidden');
    } else {
        preview.classList.add('hidden');
    }
}
</script>
