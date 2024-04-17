<?php

namespace App\Services;

use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryService
{
    /**
     * Set/Unset is_active param
     *
     * @param Category $category
     * @return void
     */
    public function toggleStoreIsActive(Category $category): void
    {
        if ($category->is_visible) {
            $category->is_visible = false;
        } else {
            $category->is_visible = true;
        }

        $category->save();
    }

    /**
     * Get active categories for specific store
     *
     * @return mixed
     */
    public function getActiveCategoriesForStore(): mixed
    {
        $storeId = auth()->id();

        return Category::where([
            'store_id' => $storeId,
            'is_visible' => true
        ])->get();
    }

    /**
     * Get all products for store if category is not set or products for specific category
     *
     * @param Category|null $category
     * @return AnonymousResourceCollection
     */
    public function getCategoryProducts(?Category $category): AnonymousResourceCollection
    {
        $storeId = auth()->id();

        if (!$category->id) {
            $products = ProductResource::collection(Product::where('store_id', $storeId)->get());
        } else {
            $products = ProductResource::collection(Product::whereHas('categories', function ($query) use ($category, $storeId) {
                $query->where('category_id', $category->id);
                $query->where('store_id', $storeId);
            })->get());
        }

        return $products;
    }
}