<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Schedule;
use App\Models\Staff;

class ScheduleController extends Controller
{
    /**
     * Display a listing of schedules.
     */
    public function view()
    {
        $staffs = Staff::all();
        $schedules = Schedule::with('staff')
            ->orderBy('date')
            ->orderBy('start_time')
            ->paginate(10);
            
        return view('admin.admin-schedule', [
            'schedules' => $schedules,
            'staffMembers' => $staffs,
        ]);
    }


    /**
     * Show the form for creating a new schedule.
     */
    public function create(Request $request)
    {
        $validated = $request->validate([
            'staff_id' => 'required|exists:staff,staffID',
            'date' => 'required|date|after_or_equal:today',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ]);

        // Generate date-based ID (SCH-YYYYMMDD-XXX)
        $datePart = now()->format('Ymd');
        $latest = Schedule::where('scheduleID', 'like', "SCH-{$datePart}-%")->latest()->first();
        $sequence = $latest ? (int)substr($latest->scheduleID, -3) + 1 : 1;
        $scheduleID = "SCH-{$datePart}-" . str_pad($sequence, 3, '0', STR_PAD_LEFT);

        $schedule = Schedule::create([
            'scheduleID' => $scheduleID,
            'staffID' => $validated['staff_id'],
            'date' => $validated['date'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'status' => 'available'
        ]);

        return back()->with('success', 'Schedule created successfully');
    }

    /**
     * Store a newly created schedule.
     */
    public function store(Request $request)
    {
        $validated = $this->validateSchedule($request);
        
        // Generate schedule ID (format: SCH-YYYYMMDD-XXX)
        $datePart = now()->format('Ymd');
        $latest = Schedule::where('scheduleID', 'like', "SCH-{$datePart}-%")->latest()->first();
        $sequence = $latest ? (int)substr($latest->scheduleID, -3) + 1 : 1;
        $scheduleID = "SCH-{$datePart}-" . str_pad($sequence, 3, '0', STR_PAD_LEFT);

        Schedule::create([
            'scheduleID' => $scheduleID,  // Your custom/generated ID
            'staffID' => $validated['staff_id'],
            'date' => $validated['date'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
    
            // Additional recommended fields
            'status' => 'active', // Default status
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.manage-schedule')
            ->with('success', 'Schedule created successfully.');
    }


    /**
     * Update the specified schedule.
     */
    public function update(Request $request)
    {
        // Get the schedule ID from the request
        $scheduleId = $request->scheduleID;
        
        // Find the schedule by ID
        $schedule = Schedule::findOrFail($scheduleId);
        
        // Validate input
        $request->validate([
            'status' => 'required|in:available,unavailable,off-day',
        ]);

        // Update schedule
        $schedule->status = $request->status;
        $schedule->save();

        return redirect()->back()->with('success', 'Schedule status updated successfully.');
    }

    /**
     * Remove the specified schedule.
     */
    public function delete(Request $request)
    {
        $scheduleId = $request->scheduleID;
        
        // Find the schedule by ID
        $schedule = Schedule::findOrFail($scheduleId);

        $schedule->delete();
        return back()->with('success', 'Schedule deleted successfully');
    }

    /**
     * Validate schedule data
     */
    protected function validateSchedule(Request $request, $scheduleID = null)
    {
        $rules = [
            'staffID' => 'required|exists:users,staffID',
            'date' => 'required|date|after_or_equal:today',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'status' => ['required', Rule::in(['available', 'unavailable', 'offday'])]
        ];

        return $request->validate($rules);
    }

    /**
     * Get available time slots for a staff member
     */
    public function availability(Request $request)
    {
        $validated = $request->validate([
            'staffID' => 'required|exists:users,staffID',
            'date' => 'required|date',
            'time' => 'required'
        ]);

        $available = Schedule::where('staffID', $validated['staffID'])
            ->where('date', $validated['date'])
            ->where('start_time', '<=', $validated['time'])
            ->where('end_time', '>=', $validated['time'])
            ->where('status', 'available')
            ->exists();

        return response()->json(['available' => $available]);
    }

}
