<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ResetStaffSchedules extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedules:reset {--days=7 : Number of days to reset}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset all staff schedules to available status from 8am to 8pm';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $staffIDs = [
            'EMP001', 'EMP002', 'EMP003', 'EMP004', 'EMP005'
        ];
        $startTime = '08:00:00';
        $endTime = '20:00:00';
        $status = 'available';
        $days = $this->option('days');

        $this->info("Resetting staff schedules for the next {$days} days...");

        // Create schedules for the specified number of days
        for ($day = 0; $day < $days; $day++) {
            $date = Carbon::today()->addDays($day)->format('Y-m-d');
            
            foreach ($staffIDs as $index => $staffID) {
                $scheduleID = 'SCH-' . Carbon::today()->addDays($day)->format('Ymd') . '-' . str_pad($index + 1, 3, '0', STR_PAD_LEFT);
                
                // Check if a schedule already exists for this staff on this date
                $existingSchedule = DB::table('schedule')
                    ->where('staffID', $staffID)
                    ->where('date', $date)
                    ->first();
                
                if ($existingSchedule) {
                    // Update existing schedule
                    DB::table('schedule')
                        ->where('scheduleID', $existingSchedule->scheduleID)
                        ->update([
                            'start_time' => $startTime,
                            'end_time' => $endTime,
                            'status' => $status,
                            'updated_at' => now(),
                        ]);
                } else {
                    // Insert new schedule
                    DB::table('schedule')->insert([
                        'scheduleID' => $scheduleID,
                        'staffID' => $staffID,
                        'date' => $date,
                        'start_time' => $startTime,
                        'end_time' => $endTime,
                        'status' => $status,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }

        $this->info("Successfully reset staff schedules for the next {$days} days!");
        $this->info("All staff are now available from 8:00 AM to 8:00 PM.");
    }
} 