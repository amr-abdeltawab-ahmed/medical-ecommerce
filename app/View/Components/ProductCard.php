<?php

namespace App\View\Components;

use App\ViewModels\ProductViewModel;
use Illuminate\View\Component;
use Illuminate\View\View;

class ProductCard extends Component
{
    public function __construct(
        public readonly ProductViewModel $product,
        public readonly bool $showAddToCart = true
    ) {}

    public function render(): View
    {
        return view('components.product-card');
    }
} 