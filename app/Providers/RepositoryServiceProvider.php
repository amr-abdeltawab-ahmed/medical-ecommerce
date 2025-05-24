<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\Eloquent\EloquentProductRepository;
use App\Repositories\Eloquent\EloquentOrderRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * All of the container bindings that should be registered.
     *
     * @var array
     */
    public array $bindings = [
        ProductRepositoryInterface::class => EloquentProductRepository::class,
        OrderRepositoryInterface::class => EloquentOrderRepository::class,
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        // Bindings are automatically registered through the $bindings property
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
} 