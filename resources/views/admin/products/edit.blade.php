@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
    <div class="container mx-auto px-4 py-8 max-w-3xl">
        <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-6">
            ✏️ Edit Product
        </h2>

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <form action="{{ route('admin.products.update', $product) }}"
              method="POST"
              enctype="multipart/form-data"
              class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                {{-- Name --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Product Name</label>
                    <input type="text"
                           name="name"
                           id="name"
                           value="{{ old('name', $product->name) }}"
                           class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                           required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Description --}}
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                    <textarea name="description"
                              id="description"
                              rows="4"
                              class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('description') border-red-500 @enderror">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Price --}}
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Price ($)</label>
                    <input type="number"
                           step="0.01"
                           name="price"
                           id="price"
                           value="{{ old('price', $product->price) }}"
                           class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('price') border-red-500 @enderror"
                           required>
                    @error('price')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Category --}}
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category</label>
                    <input type="text"
                           name="category"
                           id="category"
                           value="{{ old('category', $product->category) }}"
                           class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('category') border-red-500 @enderror">
                    @error('category')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Image --}}
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Product Image</label>
                    <input type="file"
                           name="image"
                           id="image"
                           accept="image/*"
                           class="mt-1 block w-full text-sm text-gray-500 dark:text-gray-300
                                  file:mr-4 file:py-2 file:px-4
                                  file:rounded-md file:border-0
                                  file:text-sm file:font-semibold
                                  file:bg-blue-50 file:text-blue-700
                                  hover:file:bg-blue-100
                                  dark:file:bg-gray-700 dark:file:text-gray-300"
                           onchange="previewImage(event)">
                    @error('image')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror

                    {{-- Current Image Preview --}}
                    @if($product->image)
                        <div class="mt-2">
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">Current Image:</p>
                            <img src="{{ Storage::url($product->image) }}"
                                 alt="{{ $product->name }}"
                                 class="h-32 w-32 object-cover rounded-lg">
                        </div>
                    @endif

                    {{-- New Image Preview --}}
                    <div id="imagePreview" class="hidden mt-2">
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">New Image Preview:</p>
                        <img src="#" alt="Preview" class="h-32 w-32 object-cover rounded-lg">
                    </div>
                </div>

                <div class="flex justify-end space-x-3">
                    <a href="{{ route('admin.products.index') }}"
                       class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                        Cancel
                    </a>
                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Update Product
                    </button>
                </div>
            </div>
        </form>
    </div>

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
@endsection
