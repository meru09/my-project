<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\View\View;

class CustomerController extends Controller
{
    public function index(): View
    {
        $customers = User::where('is_admin', false)->latest()->get();

        return view('admin.customers.index', compact('customers'));
    }

    public function show(User $customer): View
    {
        abort_if($customer->is_admin, 404);

        $orders = Order::where('user_id', $customer->id)->latest()->get();

        return view('admin.customers.show', compact('customer', 'orders'));
    }
}
