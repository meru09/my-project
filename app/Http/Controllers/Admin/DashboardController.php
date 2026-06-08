<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $ordersToday = Order::whereDate('created_at', now()->today())->count();
        $ordersMonth = Order::whereMonth('created_at', now()->month)->count();
        $lowStockCount = ProductVariant::where('stock', '<=', 5)->count();
        $revenue = Order::sum('total');
        $orders = Order::latest()->take(6)->get();
        $customers = User::where('is_admin', false)->count();

        return view('admin.dashboard', compact('ordersToday', 'ordersMonth', 'lowStockCount', 'revenue', 'orders', 'customers'));
    }
}
