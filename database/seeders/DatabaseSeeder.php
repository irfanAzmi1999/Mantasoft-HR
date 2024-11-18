<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            BloodSeeder::class,
            CategorySeeder::class,
            CompanySeeder::class,
            DepartmentSeeder::class,
            EmergencyTypeSeeder::class,
            LeaveTypeSeeder::class,
            MaritalSeeder::class,
            NationalitySeeder::class,
            PositionSeeder::class,
            RelationSeeder::class,
            RoleSeeder::class,
            StatusSeeder::class,
            UserSeeder::class,
            RoleUserSeeder::class,
            ProfileSeeder::class,
            StaffSeeder::class,
            LeaveQuotaSeeder::class
        ]);
    }
}
