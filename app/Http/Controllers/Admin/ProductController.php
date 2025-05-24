<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

use App\Services\Product\ProductService;

class ProductController extends Controller
{
    public function __construct(protected ProductService $productService) {}

    public function index(Request $request){
        $filters = $request->only(['search', 'category', 'sort']);
        $products = $this->productService->listProducts($filters);
        $categories = Product::distinct('category')->pluck('category')->filter();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create(){
        return view('admin.products.create');
    }

    public function store(StoreProductRequest $request){
        $this->productService->createProduct(
            $request->validated(),
            $request->file('image')
        );

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    public function edit(Product $product){
        return view('admin.products.edit', compact('product'));
    }

    public function update(UpdateProductRequest $request, Product $product){

        $this->productService->updateProduct(
            $product,
            $request->validated(),
            $request->file('image')
        );

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product){
        $this->productService->deleteProduct($product);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }
}
