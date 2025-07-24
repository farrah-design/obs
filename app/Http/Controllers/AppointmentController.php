<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\appointment;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
   public function viewAppointment()
    {
        $services = Service::all(); // Fetch all services from DB

        /** @var \App\Models\Customer $customer */
        $customer = Auth::guard('customer')->user();

        return view('customer.bookingpage', [
            'services' => $services,
            'customer' => $customer,
        ]);
    }

    public function store(Request $request)
    {
       $request->validate([
        'appointment_date' => 'required|date',
        'appointment_time' => 'required',
        'services' => 'required|array',
        'services.*' => 'exists:services,serviceID',
        'notes' => 'nullable|string'
        ]);

       /** @var \App\Models\Customer $customer */
        $customer = Auth::guard('customer')->user();


        // Create appointment instance
        $appointment = new Appointment();
        $appointment->appointmentID = uniqid('APT'); // Optional: generate ID
        $appointment->customerID = $customer->customerID;
        $appointment->date = $request->appointment_date;
        $appointment->time = $request->appointment_time;
        $appointment->status = 'pending';
        $appointment->save();

        // Attach selected services (many-to-many)
        foreach ($request->services as $serviceID) {
            $appointment->services()->attach($serviceID, [
                'serviceNotes' => $request->notes
            ]);
        }

        return redirect()->route('booking.schedule')->with('success', 'Appointment successfully booked!');
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

        return back()->with('');
    }

}
