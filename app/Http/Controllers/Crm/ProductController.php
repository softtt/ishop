<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Services\CategoryService;
use App\Services\ProductService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param Category|null $category
     * @param CategoryService $service
     * @return Response
     */
    public function index(?Category $category, CategoryService $service): Response
    {
        $products = $service->getCategoryProducts($category);

        return Inertia::render('Crm/Product/List', [
            'products' => $products,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        $categories = CategoryResource::collection(Category::where('store_id', auth()->id())->get());

        return Inertia::render('Crm/Product/Create', ['categories' => $categories]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProductRequest $request
     * @param ProductService $service
     * @return RedirectResponse
     */
    public function store(StoreProductRequest $request, ProductService $service): RedirectResponse
    {
        $request->validated();
        $service->storeProduct($request->all());

        return redirect()->route('products.index')->with('message', 'Product Created Successfully');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return Response
     */
    public function edit(Product $product): Response
    {
        $categories = CategoryResource::collection(Category::where('store_id', auth()->id())->get());
        $productArray = $product->with('categories')->find($product->id)->toArray();

        return Inertia::render('Crm/Product/Edit', [
            'product' => $productArray,
            'categories' => $categories
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductRequest $request
     * @param Product $product
     * @param ProductService $service
     * @return RedirectResponse
     */
    public function update(UpdateProductRequest $request, Product $product, ProductService $service): RedirectResponse
    {
        $request->validated();
        $service->updateProduct($product, $request);

        return redirect()->route('products.index')->with('message', 'Product Updated Successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return RedirectResponse
     */
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('products.index')->with('message', 'Product Deleted Successfully');
    }

    /**
     * Delete product cover image
     *
     * @param Product $product
     * @param ProductService $service
     * @return RedirectResponse
     */
    public function deleteCover(Product $product, ProductService $service): RedirectResponse
    {
        $service->deleteCover($product);

        return redirect()->back()->with('message', 'Cover deleted successfully');
    }
}
