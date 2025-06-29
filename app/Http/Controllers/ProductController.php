<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::with('products')->get();
        $selectedCategory = $request->query('category');

        if ($selectedCategory) {
            $products = Product::whereHas('categories', function($query) use ($selectedCategory) {
                $query->where('categories.id', $selectedCategory);
            })->get();
        } else {
            $products = Product::all();
        }

        return view('products.index', compact('products', 'categories', 'selectedCategory'));
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}