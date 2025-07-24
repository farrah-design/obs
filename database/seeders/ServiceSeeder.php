<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            ['serviceID' => 'SVC001', 'serviceName' => 'Basic Haircut (Men)', 'price' => 15.00, 'description' => 'Professional haircut with styling for MEN (Adult).', 'duration' => 1],
            ['serviceID' => 'SVC002', 'serviceName' => 'Basic Haircut (Women)', 'price' => 20.00, 'description' => 'Professional haircut with styling for WOMEN (Adult).', 'duration' => 1],
            ['serviceID' => 'SVC003', 'serviceName' => 'Basic Haircut (Teenagers)', 'price' => 15.00, 'description' => 'Professional haircut with styling for TEENAGERS.', 'duration' => 1],
            ['serviceID' => 'SVC004', 'serviceName' => 'Basic Haircut (Kids)', 'price' => 10.00, 'description' => 'Professional haircut with styling for KIDS.', 'duration' => 1],
            ['serviceID' => 'SVC005', 'serviceName' => 'Black Hair Dye and Haircut', 'price' => 40.00, 'description' => 'Coloring your hair black and trimming/styling it to your desired length/shape.', 'duration' => 2],
            ['serviceID' => 'SVC006', 'serviceName' => 'Hair Wash', 'price' => 15.00, 'description' => 'Cleansing your hair and scalp with shampoo and conditioner.', 'duration' => 1],
            ['serviceID' => 'SVC007', 'serviceName' => 'Face Wash', 'price' => 15.00, 'description' => 'Cleansing your face with a gentle cleanser.', 'duration' => 1],
            ['serviceID' => 'SVC008', 'serviceName' => 'Hair Curling', 'price' => 25.00, 'description' => 'Creating curls or waves for a bouncy, textured look.', 'duration' => 2],
            ['serviceID' => 'SVC009', 'serviceName' => 'Hair Rebonding', 'price' => 90.00, 'description' => 'Permanently straightens frizzy/curly hair.', 'duration' => 3],
            ['serviceID' => 'SVC010', 'serviceName' => 'Hair Coloring', 'price' => 150.00, 'description' => 'Change your hair color (any shade) while maintaining hair health.', 'duration' => 3],
            ['serviceID' => 'SVC011', 'serviceName' => 'Hair Treatment', 'price' => 45.00, 'description' => 'Repair and nourish your hair.', 'duration' => 1],
            ['serviceID' => 'SVC012', 'serviceName' => 'Hair Straightening', 'price' => 15.00, 'description' => 'Temporarily smoothen hair using heat tools or chemicals.', 'duration' => 1],
            ['serviceID' => 'SVC013', 'serviceName' => 'Special Occasion Styling', 'price' => 150.00, 'description' => 'Event styling for weddings and other occasions.', 'duration' => 2],
            ['serviceID' => 'SVC014', 'serviceName' => 'Bun Hairstyle', 'price' => 50.00, 'description' => 'Elegant updo perfect for formal occasions.', 'duration' => 1],
            ['serviceID' => 'SVC015', 'serviceName' => 'Hair Extensions Styling', 'price' => 150.00, 'description' => 'Blend and style extensions for length or volume.', 'duration' => 2],
        ];

        DB::table('services')->insert($services);
    }
}
