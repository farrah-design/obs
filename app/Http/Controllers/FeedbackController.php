<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    /**
     * Store newly created feedback
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|between:1,5',
            'comments' => 'nullable|string|max:500'
        ]);
        
        // Get the appointment
        $customer = Auth::guard('customer')->user();

        // Create feedback
        $feedback = Feedback::create([
            'feedbackID' => uniqid('APT'),
            'customerID' => $customer->customerID,
            'date' => now(),
            'rating' => $validated['rating'],
            'comment' => $validated['comments'],
        ]);

        // Return response
        return back()->with('success', 'Thank you for your feedback!');
    }

    /**
     * Display feedback for a specific appointment
     */
    public function show()
    {
        $feedback = Feedback::with('customer')->get();
    
        // Return the view with data
        return view('admin.feedback', [
            'feedback' => $feedback
        ]);
    }


}