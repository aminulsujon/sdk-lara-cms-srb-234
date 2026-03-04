<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactFormMail; // Ensure this Mailable exists
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    /**
     * Display the contact form
     */
    public function showForm()
    {
        return view('contact'); // Renders resources/views/contact.blade.php
    }

    /**
     * Handle form submission
     */
    public function submitForm(Request $request)
    {
        // Step 1: Validate input
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email:rfc,dns',
            'message' => 'required|min:10|max:2000',
            'phone' => 'nullable|regex:/^\+?[0-9\s\-\(\)]{7,20}$/' // Optional phone validation
        ]);

        try {
            // Step 2: Send email
            Mail::to(env('MAIL_TO_ADDRESS', 'admin@example.com'))
                ->send(new ContactFormMail($validated));

            // Step 3: Redirect with success
            return redirect()->route('contact.form')->with([
                'status' => 'success',
                'message' => 'Your message has been sent successfully!'
            ]);
            
        } catch (\Exception $e) {
            // Log error details
            Log::error('Email sending failed: ' . $e->getMessage());
            
            // Redirect with error message
            return back()->withInput()->with([
                'status' => 'error',
                'message' => 'Message could not be sent. Please try again later.'
            ]);
        }
    }
}