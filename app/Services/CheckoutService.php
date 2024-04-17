<?php

namespace App\Services;

use App\Enums\OrderStatuses;
use App\Models\Order;

class CheckoutService
{
    /**
     * Calculate order total
     *
     * @param array $productOrder
     * @return int
     */
    public function calculateTotal(array $productOrder): int
    {
        $total = 0;

        foreach ($productOrder as $product) {
            $total += $product['price'] * $product['amount'];
        }

        return $total;
    }

    /**
     * Create order
     *
     * @param array $orderData
     * @return void
     */
    public function createOrder(array $orderData): void
    {
        $order = new Order();
        $storeId = auth()->id();

        $order->store_id = $storeId;
        $order->billing_email = $orderData['billing_email'];
        $order->billing_name = $orderData['billing_name'];
        $order->billing_address = $orderData['billing_address'];
        $order->billing_total = $orderData['billing_total'];
        $order->status = OrderStatuses::Paid->value;

        $order->save();

        $this->saveProducts($orderData['products'], $order);

    }

    /**
     * Save products related to order with theirs amounts
     *
     * @param array $productsData
     * @param Order $order
     * @return void
     */
    private function saveProducts(array $productsData, Order $order): void
    {
        foreach ($productsData as $product) {
            $order->products()->attach($product['id'], ['quantity' => $product['amount']]);
        }
    }
}