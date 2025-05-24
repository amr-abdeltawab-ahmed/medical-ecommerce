<?php

namespace App\Repositories\Eloquent;

use App\Models\Order;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class EloquentOrderRepository implements OrderRepositoryInterface
{
    public function __construct(protected Order $model)
    {
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return $this->model->with('items')->paginate($perPage);
    }

    public function findById(int $id): ?Order
    {
        return $this->model->find($id);
    }

    public function create(array $data): Order
    {
        return $this->model->create($data);
    }

    public function update(Order $order, array $data): bool
    {
        return $order->update($data);
    }

    public function addItems(Order $order, array $items): void
    {
        $order->items()->createMany($items);
    }

    public function getLatestOrders(): Collection
    {
        return $this->model->with('items')
            ->latest()
            ->take(10)
            ->get();
    }

    public function findWithItems(int $id): ?Order
    {
        return $this->model->with('items')->find($id);
    }
} 