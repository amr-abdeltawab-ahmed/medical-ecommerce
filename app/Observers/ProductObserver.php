<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\ProductLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        try {
            ProductLog::create([
                'product_id' => $product->id,
                'action' => 'created',
                'changed_by' => Auth::id(),
                'changes' => [
                    'attributes' => $product->getAttributes(),
                    'timestamp' => now()->toDateTimeString(),
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to log product creation', [
                'product_id' => $product->id,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        try {
            $changes = $product->getChanges();
            $original = array_intersect_key($product->getOriginal(), $changes);

            ProductLog::create([
                'product_id' => $product->id,
                'action' => 'updated',
                'changed_by' => Auth::id(),
                'changes' => [
                    'before' => $original,
                    'after' => $changes,
                    'timestamp' => now()->toDateTimeString(),
                    'modified_fields' => array_keys($changes)
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to log product update', [
                'product_id' => $product->id,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        try {
            ProductLog::create([
                'product_id' => $product->id,
                'action' => 'deleted',
                'changed_by' => Auth::id(),
                'changes' => [
                    'final_state' => $product->getAttributes(),
                    'timestamp' => now()->toDateTimeString(),
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to log product deletion', [
                'product_id' => $product->id,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        try {
            ProductLog::create([
                'product_id' => $product->id,
                'action' => 'restored',
                'changed_by' => Auth::id(),
                'changes' => [
                    'attributes' => $product->getAttributes(),
                    'timestamp' => now()->toDateTimeString(),
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to log product restoration', [
                'product_id' => $product->id,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        //
    }
}
