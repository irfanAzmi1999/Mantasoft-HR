<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Models\RoleUser;

class RoleUserSeeder extends Seeder
{
    public function run()
    {
        $RoleUser = [
            ['role_id' => 6, 'user_id' => 1, 'user_type' => 'App\Models\User', 'delete_roleuser' => 0, 'created_at' => '2000-01-01 00:00:00', 'updated_at' => '2000-01-01 00:00:00'],
            ['role_id' => 2, 'user_id' => 2, 'user_type' => 'App\Models\User', 'delete_roleuser' => 0, 'created_at' => '2004-11-22 00:00:00', 'updated_at' => '2004-11-22 00:00:00'],
            ['role_id' => 2, 'user_id' => 3, 'user_type' => 'App\Models\User', 'delete_roleuser' => 0, 'created_at' => '2006-08-31 00:00:00', 'updated_at' => '2006-08-31 00:00:00']
        ];
        RoleUser::insert($RoleUser);
    }
}
