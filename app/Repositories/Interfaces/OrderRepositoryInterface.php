<?php

namespace App\Repositories\Interfaces;

use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface OrderRepositoryInterface
{
    public function all(): Collection;
    public function paginate(int $perPage = 10): LengthAwarePaginator;
    public function findById(int $id): ?Order;
    public function create(array $data): Order;
    public function update(Order $order, array $data): bool;
    public function addItems(Order $order, array $items): void;
    public function getLatestOrders(): Collection;
    public function findWithItems(int $id): ?Order;
} 