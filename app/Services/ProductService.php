<?php

namespace App\Services;

use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    /**
     * Store new product
     *
     * @param array $data
     * @return void
     */
    public function storeProduct(array $data): void
    {
        $cover = $data['cover'];
        $storeId = auth()->id();

        if ($cover instanceof UploadedFile) {
            $coverPath = $this->saveCover($cover, $storeId);
        }

        $product = new Product();
        $product->name = $data['name'];
        $product->details = $data['details'];
        $product->description = $data['description'];
        $product->product_code = $data['product_code'];
        $product->cover = $coverPath;
        $product->price = $data['price'];
        $product->store_id = $storeId;

        $product->save();

        if (!empty($data['categories'])) {
            $this->saveCategories($data['categories'], $product);
        }
    }


    /**
     * Update existing product
     *
     * @param Product $product
     * @param UpdateProductRequest $request
     * @return void
     */
    public function updateProduct(Product $product, UpdateProductRequest $request): void
    {
        $data = $request->all();
        $cover = $request->file('cover');

        if ($cover instanceof UploadedFile) {
            if ($product->cover) {
                $this->deleteCover($product);
            }

            $coverPath = $this->saveCover($data['cover'], auth()->id());
            $data['cover'] = $coverPath;
        } else {
            unset($data['cover']);
        }

        if (!empty($data['categories'])) {
            $categories = $data['categories'];
            $this->saveCategories($categories, $product);
        }

        unset($data['categories']);
        $product->update($data);
    }


    /**
     * Delete product cover image
     *
     * @param Product $product
     * @return bool
     */
    public function deleteCover(Product $product): bool
    {
        if (Storage::disk('public')->delete($product->cover)) {
            $product->cover = '';
            $product->save();

            return true;
        }

        return false;
    }

    /**
     * Save update product categories
     *
     * @param array $categoriesData
     * @param Product $product
     * @return void
     */
    private function saveCategories(array $categoriesData, Product $product): void
    {
        $product->categories()->detach();

        foreach ($categoriesData as $category) {
            $product->categories()->attach($category['id']);
        }
    }

    /**
     * Save cover image
     *
     * @param UploadedFile $cover
     * @param int $storeId
     * @return string
     */
    private function saveCover(UploadedFile $cover, int $storeId): string
    {
        return Storage::disk('public')->put('/' . $storeId, $cover);
    }
}

