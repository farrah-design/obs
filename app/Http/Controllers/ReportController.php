<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\AppointmentService;
use App\Models\Schedule;
use App\Models\Service;
use App\Models\Customer;
use App\Models\Staff;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


class ReportController extends Controller
{

    public function view()
        {
            return view('admin.admin-dashboard', [
            'todayAppointments' => Appointment::whereDate('date', today())->count(),
            'weekAppointments' => Appointment::whereBetween('date', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'availableSlots' => 12, // Customize with real-time logic
            'totalAppointments' => Appointment::count(),
            'totalCustomers' => Customer::count(),
        ]);
        }
    
        public function weeklyReport()
    {
    $startOfWeek = Carbon::now()->startOfWeek();
    $endOfWeek = Carbon::now()->endOfWeek();

    $appointments = Appointment::whereBetween('date', [$startOfWeek, $endOfWeek]);

    $appointments = Appointment::all();

    $total = $appointments->count();
    $completed = $appointments->where('status', 'completed')->count();
    $cancelled = $appointments->where('status', 'cancelled')->count();
    $noShows = $appointments->where('status', 'no-show')->count();
    $upcoming = $appointments->where('status', 'pending')->count();

    // Get the most popular service this week
    $popularService = Service::select('serviceName')
        ->join('appointment_service', 'services.serviceID', '=', 'appointment_service.serviceID')
        ->join('appointments', 'appointments.appointmentID', '=', 'appointment_service.appointmentID')
        ->whereBetween('appointments.date', [$startOfWeek, $endOfWeek])
        ->groupBy('services.serviceID', 'services.serviceName')
        ->orderByRaw('COUNT(*) DESC')
        ->limit(1)
        ->value('serviceName');

        $pdf = Pdf::loadView('pdf.report', [
        'total' => $total,
        'completed' => $completed,
        'cancelled' => $cancelled,
        'noShow' => $noShows,
        'appointments' => $appointments
    ]);

    return view('admin.weekly-report', compact(
        'total', 'completed', 'cancelled', 'noShows', 'upcoming', 'popularService'
    ));
}



    public function downloadPdf()
    {

        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $appointments = Appointment::whereBetween('date', [$startOfWeek, $endOfWeek]);
        $mostUsedServices = DB::table('appointment_service')
            ->select(
                'services.serviceID',
                'services.serviceName', // or other columns you need
                DB::raw('COUNT(*) as total_uses')
            )
            ->join('appointments', 'appointment_service.appointmentID', '=', 'appointments.appointmentID')
            ->join('services', 'appointment_service.serviceID', '=', 'services.serviceID')
            ->whereBetween('appointments.date', [$startOfWeek, $endOfWeek])
            ->groupBy('services.serviceID', 'services.serviceName') // Must include all non-aggregate columns
            ->orderByDesc('total_uses')
            ->first();
            
        $data = [
            'title' => 'User Report',
            'total' => (clone $appointments)->count(),
            'completed' => (clone $appointments)->where('status', 'completed')->count(),
            'cancelled' => (clone $appointments)->where('status', 'cancelled')->count(),
            'noshow' => (clone $appointments)->where('status', 'confirmed')
                    ->whereDate('date', '<', now())
                    ->count(),
            'upcoming' => (clone $appointments)->where('status', 'confirmed')
                    ->whereDate('date', '>', now())
                    ->count(),
            'mostUsedService' => $mostUsedServices->serviceName,
        ];

        $pdf = Pdf::loadView('pdf.report', $data)
            ->setPaper('a4', 'portrait')
            ->setOption([
                'isRemoteEnabled' => true,
                'defaultFont' => 'sans-serif'
            ]);


        return $pdf->download('user_report_'.now()->format('Ymd').'.pdf');
    }
}