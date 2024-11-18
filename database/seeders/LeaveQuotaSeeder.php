<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Models\LeaveQuota;

class LeaveQuotaSeeder extends Seeder
{
    public function run()
    {
        $leaveQuotaSeeder = [
            ['staff_id' => 1, 'year' => Carbon::now()->format('Y'), 'default' => 14, 'taken' => 0, 'balance' => 14, 'mc_default' => 14, 'mc_taken' => 0, 'mc_balance' => 14, 'maternity' => 60, 'paternity' => 3, 'delete_quota' => 0, 'created_at' => '2000-01-01 00:00:00', 'updated_at' => '2000-01-01 00:00:00'],
            ['staff_id' => 2, 'year' => Carbon::now()->format('Y'), 'default' => 14, 'taken' => 0, 'balance' => 14, 'mc_default' => 14, 'mc_taken' => 0, 'mc_balance' => 14, 'maternity' => 60, 'paternity' => 3, 'delete_quota' => 0, 'created_at' => '2004-11-22 00:00:00', 'updated_at' => '2004-11-22 00:00:00'],
            ['staff_id' => 3, 'year' => Carbon::now()->format('Y'), 'default' => 14, 'taken' => 0, 'balance' => 14, 'mc_default' => 14, 'mc_taken' => 0, 'mc_balance' => 14, 'maternity' => 60, 'paternity' => 3, 'delete_quota' => 0, 'created_at' => '2006-08-31 00:00:00', 'updated_at' => '2006-08-31 00:00:00']
        ];
        LeaveQuota::insert($leaveQuotaSeeder);
    }
}
