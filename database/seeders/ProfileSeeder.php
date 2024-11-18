<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Models\Profile;

class ProfileSeeder extends Seeder
{
    public function run()
    {
        $profile = [
            ['user_id' => 1, 'phone' => '0341441220', 'delete_profile' => 0, 'created_at' => '2000-01-01 00:00:00', 'updated_at' => '2000-01-01 00:00:00'],
            ['user_id' => 2, 'phone' => '0122888222', 'delete_profile' => 0, 'created_at' => '2004-11-22 00:00:00', 'updated_at' => '2004-11-22 00:00:00'],
            ['user_id' => 3, 'phone' => '0192141119', 'delete_profile' => 0, 'created_at' => '2006-08-31 00:00:00', 'updated_at' => '2006-08-31 00:00:00']
        ];
        Profile::insert($profile);
    }
}
