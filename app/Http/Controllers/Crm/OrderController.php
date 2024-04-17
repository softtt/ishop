<?php

namespace App\Http\Controllers\Crm;

use App\Enums\OrderStatuses;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $storeId = auth()->id();
        $orders = OrderResource::collection(Order::where('store_id', $storeId)->get());

        return Inertia::render('Crm/Order/List', [
            'orders' => $orders,
        ]);
    }

    /**
     * Show single order page
     *
     * @param Order $order
     * @return Response
     */
    public function show(Order $order): Response
    {
        $products = $order->products()->withPivot('quantity')->get();

        return Inertia::render('Crm/Order/Show', [
            'order' => $order,
            'products' => $products
        ]);
    }

    /**
     * Mark order as completed
     *
     * @param Order $order
     * @return RedirectResponse
     */
    public function markAsCompleted(Order $order): RedirectResponse
    {
        $order->status = OrderStatuses::Completed->value;
        $order->save();

        return redirect()->route('orders.index')->with('message', 'Order status changed');
    }
}
