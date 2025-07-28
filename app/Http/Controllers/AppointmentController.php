<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\appointment;
use App\Models\Service;
use App\Models\Staff;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
   public function viewAppointment()
    {
        $services = Service::all(); // Fetch all services from DB

        /** @var \App\Models\Customer $customer */
        $customer = Auth::guard('customer')->user();

        // Get all staff members
        $staffMembers = Staff::all();

        return view('customer.bookingpage', [
            'services' => $services,
            'customer' => $customer,
            'staffMembers' => $staffMembers,
        ]);
    }

    public function getAvailableSlots(Request $request)
    {
        $date = $request->input('date');
        $customer = Auth::guard('customer')->user();

        $openingTime = 8;  // 8 AM
        $closingTime = 20; // 8 PM

        $now = now();
        $requestedDate = Carbon::parse($date);

        $availableTimes = [];

        for ($hour = $openingTime; $hour < $closingTime; $hour++) {
            $timeSlot = sprintf('%02d:00:00', $hour);
            $dateTime = $requestedDate->copy()->setTime($hour, 0, 0);

            // Skip past times if date is today
            if ($requestedDate->isToday() && $dateTime->lessThan($now->addHour())) {
                continue;
            }

            $isBooked = Appointment::where('date', $date)
                ->where('time', $timeSlot)
                ->exists();

            $alreadyBookedByCustomer = Appointment::where('date', $date)
                ->where('time', $timeSlot)
                ->where('customerID', $customer->customerID)
                ->exists();

            if (!$isBooked && !$alreadyBookedByCustomer) {
                $availableTimes[] = $dateTime->format('H:i'); // 24-hour format, no seconds

            }
        }

        return response()->json($availableTimes);
    }


private function generateTimeSlots($start, $end, $interval)
{
    $slots = [];
    $current = strtotime($start);
    $end = strtotime($end);

    while ($current <= $end) {
        $slots[] = date('H:i', $current);
        $current = strtotime("+$interval minutes", $current);
    }

    return $slots;
}

    public function store(Request $request)
    {
       $request->validate([
                'appointment_date' => 'required|date',
                'appointment_time' => 'required',
                'services' => 'required|array',
                'services.*' => 'exists:services,serviceID',
                'name' => 'required|string',
                'phone' => 'required|string',
                'email' => 'nullable|email',
                'stylist' => 'nullable|string',
                'notes' => 'nullable|string'
            ]);

            // Your existing customer and availability checks...

            // Create appointment
            $appointment = new Appointment();
            $appointment->appointmentID = uniqid('APT');
            $appointment->customerID = Auth::guard('customer')->user()->customerID;
            $appointment->date = $request->appointment_date;
            $appointment->time = $request->appointment_time;
            $appointment->appointment_note = $request->notes;
            $appointment->status = 'pending';
            $appointment->save();

            // Attach services
            foreach ($request->services as $serviceID) {
                $appointment->services()->attach($serviceID, [
                    'serviceNotes' => $request->notes
                ]);
            }

        
        return view('booking.schedule');
    }

    public function reschedule(Request $request)
    {
        $validated = $request->validate([
            'appointment_id' => 'required|exists:appointments,appointmentID',
            'new_date' => 'required|date|after_or_equal:today',
            'new_time' => 'required'
        ]);

        // Convert time format from "8:00 AM" to "08:00"
        $time24hr = date('H:i', strtotime($validated['new_time']));

        /** @var \App\Models\Customer $customer */
        $customer = Auth::guard('customer')->user();

        $appointment = Appointment::where('appointmentID', $validated['appointment_id'])
            ->where('customerID', $customer->customerID) // Verify ownership
            ->firstOrFail();

        $appointment->update([
            'date' => $validated['new_date'],
            'time' => $time24hr // Use converted time
        ]);

        return back()->with('success', 'Appointment rescheduled successfully!');
    }

    public function viewAschedule(Request $request){
        /** @var \App\Models\Customer $customer */
        $customer = Auth::guard('customer')->user();

        $appointments = $customer->appointments()->with('services')->get(); // Eager load services if needed

        return view('customer.bookingschedule', compact('appointments'));
    }
    
    public function viewAllAppointments()
    {
        $appointments = Appointment::all();
        return view('admin.admin-appointment', compact('appointments'));

    }

    public function viewUpcomingAppointments()
    {
        $appointments = Appointment::whereIn('status', [ null, 'confirmed'])
                              ->orderBy('date', 'desc')
                              ->get();
    
        return view('admin.admin-appointment', compact('appointments'));

    }

    public function viewPastAppointments()
    {
         $appointments = Appointment::where('status', [ 'completed', 'cancelled'])
                              ->orderBy('date', 'desc')
                              ->get();
    
        return view('admin.admin-appointment', compact('appointments'));

    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'appointment_id' => 'required|exists:appointments,appointmentID', // Change to your actual PK column
            'status' => 'required|in:confirmed,cancelled,completed', // Added 'completed'
        ]);

        $appointment = Appointment::where('appointmentID', $request->appointment_id)->first();
        $appointment->status = $request->status;
        $appointment->save();

        return back()->with('success', 'Status updated!');
    }

    public function cancelStatus(Request $request){

       $validated = $request->validate([
            'appointment_id' => 'required|exists:appointments,appointmentID',
            'cancellation_reason' => 'required_if:status,cancelled|nullable|string|max:500' // Conditional validation
        ]);

        // Find and update appointment
         Appointment::where('appointmentID', $validated['appointment_id'])
              ->update(['status' => 'cancelled','appointment_note' => $validated['cancellation_reason']]);

        return back()->with('');
    }

}
