<?php

namespace App\Services\Product;

use App\Models\Product;
use App\Repositories\Eloquent\EloquentProductRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;

class ProductService
{
    public function __construct(protected EloquentProductRepository $repository)
    {
    }

    public function listProducts(array $filters)
    {
        $query = $this->repository->getModel()->newQuery();

        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('name', 'like', "%{$filters['search']}%")
                    ->orWhere('description', 'like', "%{$filters['search']}%");
            });
        }

        if (!empty($filters['category'])) {
            $query->where('category', $filters['category']);
        }

        switch ($filters['sort'] ?? null) {
            case 'oldest':
                $query->oldest();
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            default:
                $query->latest();
        }

        return $query->paginate(10)->withQueryString();
    }

    public function createProduct(array $data, ?UploadedFile $image = null): Product
    {
        try {
            Log::info('Creating product', ['data' => $data, 'has_image' => !is_null($image)]);
            return $this->repository->createWithImage($data, $image);
        } catch (\Exception $e) {
            Log::error('Error creating product', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    public function updateProduct(Product $product, array $data, ?UploadedFile $image = null): bool
    {
        try {
            Log::info('Updating product', [
                'product_id' => $product->id,
                'data' => $data,
                'has_image' => !is_null($image)
            ]);

            $result = $this->repository->updateWithImage($product, $data, $image);

            Log::info('Product update result', [
                'product_id' => $product->id,
                'success' => $result
            ]);

            return $result;
        } catch (\Exception $e) {
            Log::error('Error updating product', [
                'product_id' => $product->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    public function deleteProduct(Product $product): bool
    {
        try {
            Log::info('Deleting product', ['product_id' => $product->id]);
            return $this->repository->delete($product);
        } catch (\Exception $e) {
            Log::error('Error deleting product', [
                'product_id' => $product->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }
}
