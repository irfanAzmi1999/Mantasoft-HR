<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    public function run()
    {
        $departments = [
            ['name' => 'ADMIN', 'fullname' => 'ADMIN', 'order_number' => 3, 'delete_department' => 0, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['name' => 'COMPANY', 'fullname' => 'COMPANY', 'order_number' => 4, 'delete_department' => 0, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['name' => 'EPST', 'fullname' => 'ENTERPRISE PROFESSIONAL SERVICES TEAM', 'order_number' => 8, 'delete_department' => 0,'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['name' => 'EXECUTIVE', 'fullname' => 'EXECUTIVE', 'order_number' => 1, 'delete_department' => 0, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['name' => 'HR & FINANCE', 'fullname' => 'HR & FINANCE', 'order_number' => 2, 'delete_department' => 0, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['name' => 'INTERNSHIP', 'fullname' => 'INTERNSHIP', 'order_number' => 12, 'delete_department' => 0, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['name' => 'MANAGEMENT', 'fullname' => 'MANAGEMENT', 'order_number' => 11, 'delete_department' => 0, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['name' => 'PMT', 'fullname' => 'PROJECT MANAGEMENT TEAM', 'order_number' => 7, 'delete_department' => 0, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['name' => 'SALES', 'fullname' => 'SALES', 'order_number' => 5, 'delete_department' => 0, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['name' => 'SALES COORDINATOR', 'fullname' => 'SALES COORDINATOR', 'order_number' => 6, 'delete_department' => 0, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['name' => 'SDT', 'fullname' => 'SOFTWARE DEVELOPMENT TEAM', 'order_number' => 10, 'delete_department' => 0, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['name' => 'SMST', 'fullname' => 'SUPPORT MAINTENANCE SERVICES TEAM', 'order_number' => 9, 'delete_department' => 0, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')]
        ];
        Department::insert($departments);
    }
}
