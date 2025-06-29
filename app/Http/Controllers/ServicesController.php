<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Database\QueryException;

class ServicesController extends Controller
{
    public function index()
    {
        try {
            $services = Service::where('is_available', true)->get();
        } catch (QueryException $e) {
            // Jika kolom is_available belum ada, ambil semua layanan
            $services = Service::all();
        }
        
        return view('services.index', compact('services'));
    }

    public function show($id)
    {
        $service = Service::findOrFail($id);
        return view('services.show', compact('service'));
    }
}