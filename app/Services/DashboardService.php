<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;

class DashboardService
{
    /**
     * Get dashboard statistics
     *
     * @param int $storeId
     * @return array
     */
    public function getDashboardStatistics(int $storeId): array
    {
        $statistics['categoriesCount'] = Category::where(['store_id'  => $storeId])->count();
        $statistics['productsCount'] = Product::where(['store_id'  => $storeId])->count();
        $statistics['ordersCount'] = Order::where(['store_id'  => $storeId])->count();

        return $statistics;
    }
}