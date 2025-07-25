<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Schedule;
use App\Models\Service;
use App\Models\Customer;
use App\Models\Staff;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;


class ReportController extends Controller
{

public function view()
    {
        $today = Carbon::today()->toDateString(); // Format: Y-m-d
    
        $todaySchedules = Schedule::whereDate('date', $today)
            ->orderBy('start_time')
            ->get();

        return view('admin.admin-dashboard',[
            'todaySchedules'=>$todaySchedules,
        ]);
    }

    public function downloadPdf()
    {
        $data = [
            'title' => 'User Report',
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