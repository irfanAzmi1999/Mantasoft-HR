<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Models\Staff;

class StaffSeeder extends Seeder
{
    public function run()
    {
        $staff = [
            ['user_id' => 1, 'department_id' => 1, 'company_id' => 1, 'employ_date' => '2000-01-01', 'delete_staff' => 0, 'created_at' => '2000-01-01 00:00:00', 'updated_at' => '2000-01-01 00:00:00'],
            ['user_id' => 2, 'department_id' => 4, 'company_id' => 1, 'employ_date' => '2004-11-22', 'delete_staff' => 0, 'created_at' => '2004-11-22 00:00:00', 'updated_at' => '2004-11-22 00:00:00'],
            ['user_id' => 3, 'department_id' => 4, 'company_id' => 1, 'employ_date' => '2006-08-31', 'delete_staff' => 0, 'created_at' => '2006-08-31 00:00:00', 'updated_at' => '2006-08-31 00:00:00']
        ];
        Staff::insert($staff);
    }
}
