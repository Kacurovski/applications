<?php

namespace App\Http\Controllers;

use App\Models\CustomOrder;
use Illuminate\Http\Request;

class CustomOrderController extends Controller
{
    public function index()
    {
        $customOrders = CustomOrder::all();

        return view('custom_orders.index', compact('customOrders'));
    }

    public function show(CustomOrder $customOrder)
    {
        return view('custom_orders.show', compact('customOrder'));
    }
}
