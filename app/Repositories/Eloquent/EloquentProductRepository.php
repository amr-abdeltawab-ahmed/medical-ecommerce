<?php

namespace App\Repositories\Eloquent;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Support\Traits\HasImage;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection as SupportCollection;

class EloquentProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    use HasImage;

    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    public function findById(int $id): ?Product
    {
        return $this->model->find($id);
    }

    public function create(array $data): Product
    {
        /** @var Product */
        return parent::create($data);
    }

    public function search(string $query): Collection
    {
        return $this->model->where('name', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->get();
    }

    public function findByIds(array $ids): Collection
    {
        return $this->model->whereIn('id', $ids)->get();
    }

    public function createWithImage(array $data, ?UploadedFile $image = null): Product
    {
        if ($image) {
            $data['image'] = $this->storeImage($image, 'products');
        }

        return $this->create($data);
    }

    public function updateWithImage(Product $product, array $data, ?UploadedFile $image = null): bool
    {

        if ($image) {
            $data['image'] = $this->updateImage($image, $product->image, 'products');
        }

        return $this->update($product, $data);
    }

    public function delete(Model $model): bool
    {
        if (!$model instanceof Product) {
            throw new \InvalidArgumentException('Model must be an instance of Product');
        }

        $this->deleteImage($model->image);
        return parent::delete($model);
    }

    public function findByCategory(int $categoryId): Collection
    {
        return $this->remember("category_{$categoryId}", function () use ($categoryId) {
            return $this->model->where('category_id', $categoryId)->get();
        });
    }

    public function getModel(): Model
    {
        return $this->model;
    }

    public function searchByName(string $query): Collection
    {
        return $this->remember("search_{$query}", function () use ($query) {
            return $this->model->where('name', 'like', "%{$query}%")->get();
        });
    }
}
