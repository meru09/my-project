<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:5000',
        ]);

        // Store contact message in database or send email
        // For now, we just flash a success message
        return back()->with('status', 'Thank you for your message! Our BeautyGlow support team will respond within one business day.');
    }
}