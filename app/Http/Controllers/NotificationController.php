<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\appointment;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AppointmentReminder;  

class NotificationController extends Controller
{
    /**
     * Display the notifications management page
     */
    public function index()
    {
        $upcomingAppointments = Appointment::with('customer', 'service')
            ->where('status', 'upcoming')
            ->orderBy('appointment_date')
            ->orderBy('appointment_time')
            ->get();

        return view('notifications.index', [
            'appointments' => $upcomingAppointments
        ]);
    }

    /**
     * Show the form for sending a reminder notification
     */
    public function createReminder(Appointment $appointment)
    {
        return view('notifications.reminder', [
            'appointment' => $appointment,
            'autoMessage' => $this->generateReminderMessage($appointment)
        ]);
    }

    /**
     * Send the reminder notification
     */
    public function sendReminder(Request $request, Appointment $appointment)
    {
        $request->validate([
            'message' => 'required|string'
        ]);

        // Send notification
        Notification::send(
            $appointment->customer,
            new AppointmentReminder($appointment, $request->message)
        );

        return redirect()->route('notifications.index')
            ->with('success', 'Reminder notification sent successfully!');
    }

    /**
     * Generate automatic reminder message
     */
    protected function generateReminderMessage(Appointment $appointment)
    {
        $date = $appointment->appointment_date->format('F j, Y');
        $time = $appointment->appointment_time->format('h:i A');
        
        return "Hi {$appointment->customer->name}! Just a reminder about your {$appointment->service->name} " .
               "appointment on {$date} at {$time}. See you then!";
    }
    }
