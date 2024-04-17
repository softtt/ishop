<?php

namespace App\Listeners;

use App\Models\Store;
use App\Models\User;
use App\Services\ProductService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateStoreForUser
{
    /**
     * Handle the event.
     */
    public function handle(User $user): void
    {
        Store::create([
            'id' => $user->id,
            'name' => $user->name . "'s " . 'Store',
            'short_description' => 'It is a default description, change it!',
            'user_id' => $user->id,
            'is_active' => true
        ]);

        $user->deleting(function ($user) {
            $productService = new ProductService();
            $user->store()->delete();

            $user->store->orders()->each(function ($order){
                $order->delete();
            });

            $user->store()->categories()->each(function ($category) {
                $category->delete();
            });

            $user->store()->products()->each(function ($product) use ($productService) {
                $productService->deleteCover($product);
                $product->delete();
            });
        });
    }
}
