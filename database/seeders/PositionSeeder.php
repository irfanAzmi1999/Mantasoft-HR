<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Models\Position;

class PositionSeeder extends Seeder
{
    public function run()
    {
        $positions = [
            ['department_id' => 1, 'name' => 'ADMIN', 'delete_position' => 0, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['department_id' => 4, 'name' => 'CHIEF EXECUTIVE OFFICER', 'delete_position' => 0, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['department_id' => 2, 'name' => 'DESPATCH', 'delete_position' => 0, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['department_id' => 3, 'name' => 'EPST MANAGER', 'delete_position' => 0, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['department_id' => 4, 'name' => 'EXECUTIVE DIRECTOR', 'delete_position' => 0, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['department_id' => 5, 'name' => 'HR & FINANCE MANAGER', 'delete_position' => 0, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['department_id' => 6, 'name' => 'INTERN', 'delete_position' => 0, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['department_id' => 3, 'name' => 'IT SECURITY', 'delete_position' => 0, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['department_id' => 1, 'name' => 'OFFICE ADMINISTRATIVE EXECUTIVE', 'delete_position' => 0, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['department_id' => 2, 'name' => 'PERSONAL DRIVER', 'delete_position' => 0, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['department_id' => 11, 'name' => 'PROGRAMMER', 'delete_position' => 0, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['department_id' => 8, 'name' => 'PROJECT MANAGER', 'delete_position' => 0, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['department_id' => 6, 'name' => 'PROTÉGÉ', 'delete_position' => 0, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['department_id' => 10, 'name' => 'SALES ADMINISTRATIVE EXECUTIVE', 'delete_position' => 0, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['department_id' => 9, 'name' => 'SALES DIRECTOR', 'delete_position' => 0, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['department_id' => 9, 'name' => 'SALES MANAGER', 'delete_position' => 0, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['department_id' => 11, 'name' => 'SDT MANAGER', 'delete_position' => 0, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['department_id' => 8, 'name' => 'SENIOR PROJECT MANAGER', 'delete_position' => 0, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['department_id' => 11, 'name' => 'SYSTEM ANALYST', 'delete_position' => 0, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['department_id' => 12, 'name' => 'TEAM LEADER', 'delete_position' => 0, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['department_id' => 3, 'name' => 'TECHNICAL ENGINEER', 'delete_position' => 0, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['department_id' => 3, 'name' => 'TECHNICIAN', 'delete_position' => 0, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['department_id' => 12, 'name' => 'TECHNICIAN', 'delete_position' => 0, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')]
        ];
        Position::insert($positions);
    }
}
