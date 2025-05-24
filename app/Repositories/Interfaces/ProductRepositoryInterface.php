<?php

namespace App\Repositories\Interfaces;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProductRepositoryInterface
{
    public function all(): Collection;
    public function paginate(int $perPage = 10): LengthAwarePaginator;
    public function findById(int $id): ?Product;
    public function create(array $data): Product;
    public function update(Product $product, array $data): bool;
    public function delete(Product $product): bool;
    public function search(string $query): Collection;
    public function findByIds(array $ids): Collection;
} 