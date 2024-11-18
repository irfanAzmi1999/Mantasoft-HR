<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        $user = [
            ['username' => 'super_admin', 'name' => 'SUPER ADMIN', 'email' => 'vncareline@vn.net.my', 'password' => Hash::make('1231231'), 'delete_user' => 0, 'created_at' => '2000-01-01 00:00:00', 'updated_at' => '2000-01-01 00:00:00'],
            ['username' => 'aznan', 'name' => 'AZNAN RIZAL BIN MOHD SHAFRI', 'email' => 'arms@vn.net.my', 'password' => Hash::make('1231231'), 'delete_user' => 0, 'created_at' => '2004-11-22 00:00:00', 'updated_at' => '2004-11-22 00:00:00'],
            ['username' => 'faizal', 'name' => 'FAIZAL BIN JAMAT', 'email' => 'faizalj@vn.net.my', 'password' => Hash::make('1231231'), 'delete_user' => 0, 'created_at' => '2006-08-31 00:00:00', 'updated_at' => '2006-08-31 00:00:00']
        ];
        User::insert($user);
    }
}
