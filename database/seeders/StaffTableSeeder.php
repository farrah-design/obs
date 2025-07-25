<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class StaffTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = [
            [
                'staffID' => 'EMP001',
                'name' => 'Suni',
                'email' => 'tyhtbt@gmail.com',
                'phone' => '01112345678',
                'role' => 'employee',
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'staffID' => 'EMP002',
                'name' => 'Ida',
                'email' => 'xcxvxd@gmail.com',
                'phone' => '0122345678',
                'role' => 'employee',
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'staffID' => 'EMP003',
                'name' => 'Vina',
                'email' => 'zxcdsf@gmail.com',
                'phone' => '0133456789',
                'role' => 'employee',
                'password' => Hash::make('sdfghj23@#DC.i/'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'staffID' => 'EMP004',
                'name' => 'Era',
                'email' => 'njghyu@gmail.com',
                'phone' => '0144567890',
                'role' => 'employee',
                'password' => Hash::make('sdfghj23@#DC.i/'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'staffID' => 'EMP005',
                'name' => 'Nana',
                'email' => 'lasdnf@gmail.com',
                'phone' => '0155678901',
                'role' => 'employee',
                'password' => Hash::make('sdfghj23@#DC.i/'),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        DB::table('staff')->insert($employees);
    }
}
