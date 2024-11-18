<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Models\Nationality;

class NationalitySeeder extends Seeder
{
    public function run()
    {
        $nationalities = [
            ['name' => 'MALAYSIA', 'delete_nationality' => 0, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')]
        ];
        Nationality::insert($nationalities);
    }
}
