<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::query();

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }

        // Filter by service type
        if ($request->has('type') && $request->type != '') {
            if ($request->type == 'hydrocleaning') {
                $query->where('name', 'LIKE', '%hydrocleaning%');
            } elseif ($request->type == 'regular') {
                $query->where('name', 'NOT LIKE', '%hydrocleaning%');
            }
        }

        // Sorting functionality
        $sortBy = $request->get('sort', 'name');
        $sortOrder = $request->get('order', 'asc');
        
        if (in_array($sortBy, ['name', 'price', 'created_at'])) {
            $query->orderBy($sortBy, $sortOrder);
        } else {
            $query->orderBy('name', 'asc');
        }

        $services = $query->where('is_available', true)->get();
        
        return view('services.index', compact('services'));
    }
}