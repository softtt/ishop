<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderPlacingRequest;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Services\CategoryService;
use App\Services\CheckoutService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class StoreFrontController extends Controller
{
    /**
     * Main storefront page
     *
     * @param Category|null $category
     * @param CategoryService $service
     * @return Response
     */
    public function index(?Category $category, CategoryService $service): Response
    {
        $products = $service->getCategoryProducts($category);

        return Inertia::render('Dashboard', ['products' => $products, 'category' => $category]);
    }

    /**
     * Checkout details page
     *
     * @param Request $request
     * @param CheckoutService $service
     * @return Response
     */
    public function checkout(Request $request, CheckoutService $service): Response
    {
        $cartData = $request->get('cart');

        if (!empty($cartData)) {
            $orderTotal = $service->calculateTotal($cartData);

            return Inertia::render('Checkout', ['products' => $cartData, 'orderTotal' => $orderTotal]);
        }

        $products = ProductResource::collection(Product::where('store_id', auth()->id())->get());

        return Inertia::render('Dashboard', ['products' => $products]);
    }

    /**
     * Order creation
     *
     * @param OrderPlacingRequest $request
     * @param CheckoutService $service
     * @return Response
     */
    public function placeOrder(OrderPlacingRequest $request, CheckoutService $service): Response
    {
        $request->validated();
        $service->createOrder($request->all());

        return Inertia::render('Success');
    }

    /**
     * Show order details page
     *
     * @param Product $product
     * @param Category|null $category
     * @return Response
     */
    public function productDetails(Product $product, ?Category $category): Response
    {
        return Inertia::render('ProductDetails', ['product' => $product, 'category' => $category]);
    }
}
