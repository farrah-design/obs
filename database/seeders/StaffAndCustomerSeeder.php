<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class StaffAndCustomerSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('staff')->insert([
            'staffID' => 'S001',
            'name' => 'Branch Manager',
            'email' => 'manager@example.com',
            'password' => Hash::make('manager123'),
            'role' => 'manager',
        ]);

        DB::table('staff')->insert([
            'staffID' => 'S002',
            'name' => 'System Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        DB::table('customers')->insert([
            'customerID' => 'C001',
            'name' => 'John Doe',
            'email' => 'customer@example.com',
            'password' => Hash::make('customer123'),
        ]);
    }
}

