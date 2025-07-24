<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Query produk terlaris berdasarkan jumlah penjualan (order_products)
        $bestSellingProducts = \App\Models\Product::select('products.*')
            ->join('order_products', 'products.id', '=', 'order_products.product_id')
            ->where('is_available', true)
            ->groupBy('products.id')
            ->orderByRaw('SUM(order_products.quantity) DESC')
            ->limit(4)
            ->get();
        return view('home', compact('bestSellingProducts'));
    }
}