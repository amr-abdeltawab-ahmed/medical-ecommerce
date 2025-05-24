<nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <img src="{{ asset('storage/icon.png') }}" alt="Logo" class="block h-9 w-auto" />
                        <span class="ml-2 text-xl font-bold text-gray-800 dark:text-white">PharmaGo</span>
                    </a>
                </div>
            </div>

            <div class="flex items-center space-x-4">
                <!-- Cart -->
                <a href="{{ route('cart') }}" class="flex items-center text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    @if(session()->has('cart') && count(session('cart')) > 0)
                        <span class="ml-1 text-sm font-medium bg-blue-600 dark:bg-blue-500 text-white rounded-full px-2">
                            {{ count(session('cart')) }}
                        </span>
                    @endif
                </a>

                <!-- Login -->
                <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 dark:bg-blue-500 text-white rounded-md hover:bg-blue-700 dark:hover:bg-blue-600">
                    {{ __('Login') }}
                </a>
            </div>
        </div>
    </div>
</nav>
