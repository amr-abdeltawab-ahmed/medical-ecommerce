@extends('layouts.app')

@section('title', isset($product) ? 'Edit Product' : 'Add Product')

@section('content')
    <div class="container mx-auto px-4 py-8 max-w-3xl">
        <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-6">
            {{ isset($product) ? '✏️ Edit Product' : '➕ Add New Product' }}
        </h2>

        <form action="{{ isset($product) ? route('admin.products.update', $product) : route('admin.products.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
            @csrf
            @if(isset($product))
                @method('PUT')
            @endif

            @include('admin.products.form')
        </form>
    </div>
@endsection
