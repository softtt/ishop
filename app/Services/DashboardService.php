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
     * @return array
     */
    public function getDashboardStatistics(): array
    {
        $statistics['categoriesCount'] = Category::count();
        $statistics['productsCount'] = Product::count();
        $statistics['ordersCount'] = Order::count();

        return $statistics;
    }
}