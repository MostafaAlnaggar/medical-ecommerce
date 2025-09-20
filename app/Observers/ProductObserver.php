<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\ProductLog;
use Illuminate\Support\Facades\Auth;

class ProductObserver
{
    protected function log(Product $product, string $action)
    {
        $userId = Auth::id(); // may be null for CLI actions
        $changes = null;

        if ($action === 'created') {
            $changes = ['after' => $product->getAttributes()];
        } elseif ($action === 'updated') {
            $diffKeys = array_keys($product->getChanges());
            $before = array_intersect_key($product->getOriginal(), array_flip($diffKeys));
            $after = array_intersect_key($product->getAttributes(), array_flip($diffKeys));
            $changes = ['before' => $before, 'after' => $after];
        } elseif ($action === 'deleted') {
            $changes = ['before' => $product->getOriginal()];
        }

        ProductLog::create([
            'product_id' => $product->id,
            'action' => $action,
            'changed_by' => $userId,
            'changes' => $changes,
        ]);
    }

    public function created(Product $product)
    {
        $this->log($product, 'created');
    }

    public function updated(Product $product)
    {
        $this->log($product, 'updated');
    }

    public function deleted(Product $product)
    {
        // For soft deletes 'deleted' is fired
        $this->log($product, 'deleted');
    }

    public function restored(Product $product)
    {
        $this->log($product, 'restored');
    }
}
