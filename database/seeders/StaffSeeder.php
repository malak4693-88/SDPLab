<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Staff;

class StaffSeeder extends Seeder
{
    public function run(): void
    {
        Staff::firstOrCreate(
            ['email' => 'malak@example.com'],
            [
                'name' => 'malak',
                'password' => '12345678',
                'phone_number' => '1434567890',
                'role' => 'admin',
            ]
        );
    }
}
