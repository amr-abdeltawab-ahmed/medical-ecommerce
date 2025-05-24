<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Admin Dashboard
        </h2>
    </x-slot>

    @section('content')
        <div class="py-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                        Welcome, {{ auth()->user()->name }}!
                    </h3>

                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('admin.products.index') }}"
                           class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded text-center">
                            🛒 Manage Products
                        </a>

                        <a href="{{ route('admin.orders.index') }}"
                           class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded text-center">
                            📦 View Orders
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</x-app-layout>
