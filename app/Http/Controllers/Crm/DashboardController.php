<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    /**
     * CRM statistics
     *
     * @param DashboardService $service
     * @return Response
     */
    public function index(DashboardService $service): Response
    {
        $storeId = auth()->id();
        $statistics = $service->getDashboardStatistics($storeId);

        return Inertia::render('Crm/Dashboard', ['statistics' => $statistics]);
    }
}
