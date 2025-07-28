<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $staffIDs = [
            'EMP001', 'EMP002', 'EMP003', 'EMP004', 'EMP005'
        ];
        $startTime = '08:00:00';
        $endTime = '20:00:00';
        $status = 'available';

        // Create schedules for the next 7 days
        for ($day = 0; $day < 7; $day++) {
            $date = Carbon::today()->addDays($day)->format('Y-m-d');
            
            foreach ($staffIDs as $index => $staffID) {
                $scheduleID = 'SCH-' . Carbon::today()->addDays($day)->format('Ymd') . '-' . str_pad($index + 1, 3, '0', STR_PAD_LEFT);
                
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
} 