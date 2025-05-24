<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\Eloquent\EloquentProductRepository;
use App\Repositories\Eloquent\EloquentOrderRepository;
use App\Services\Cart\CartService;
use App\Services\Order\OrderService;

use App\Models\Product;
use App\Observers\ProductObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Bind repositories
        $this->app->bind(ProductRepositoryInterface::class, EloquentProductRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, EloquentOrderRepository::class);

        // Bind services
        $this->app->singleton(CartService::class);
        
        $this->app->bind(OrderService::class, function ($app) {
            return new OrderService(
                $app->make(OrderRepositoryInterface::class),
                $app->make(CartService::class)
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Product::observe(ProductObserver::class);
    }

}
