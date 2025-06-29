<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'message' => 'required|string'
            ]);

            // Send email
            Mail::to('reinoufal05@gmail.com')->send(new ContactFormMail($validated));

            return redirect()->route('contact.index')
                ->with('success', 'Pesan Anda berhasil terkirim. Kami akan segera menghubungi Anda.');
                
        } catch (\Exception $e) {
            Log::error('Contact form error: ' . $e->getMessage());
            return redirect()->route('contact.index')
                ->with('error', 'Maaf, terjadi kesalahan. Silakan coba lagi nanti.');
        }
    }
}