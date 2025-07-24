<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function detail($id)
    {
        $order = Order::with(['products', 'services', 'user'])->findOrFail($id);
        return view('order.detail', compact('order'));
    }

    public function invoice($id)
    {
        $order = \App\Models\Order::with(['products', 'services', 'user'])->findOrFail($id);
        return view('order.invoice', compact('order'));
    }
} 