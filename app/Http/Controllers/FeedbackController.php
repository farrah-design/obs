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
    public function show($appointmentId)
    {
        $feedback = Feedback::where('appointment_id', $appointmentId)
            ->with('customer')
            ->firstOrFail();

        return response()->json([
            'feedback' => $feedback,
            'stars' => $feedback->stars // Using the accessor from model
        ]);
    }

    /**
     * Get all feedback for the authenticated customer
     */
    public function customerFeedback()
    {
        $feedback = Feedback::where('customerID', Auth::id())
            ->with('appointment.services')
            ->orderBy('date', 'desc')
            ->paginate(10);

        return response()->json([
            'feedback' => $feedback
        ]);
    }

    /**
     * Get recent feedback for admin dashboard
     */
    public function recent()
    {
        $feedback = Feedback::with(['customer', 'appointment'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return response()->json([
            'recent_feedback' => $feedback
        ]);
    }

}