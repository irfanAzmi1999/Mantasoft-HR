<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Models\Marital;

class MaritalSeeder extends Seeder
{
    public function run()
    {
        $maritals = [
            ['name' => 'BELUM BERKAHWIN', 'delete_marital' => 0, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['name' => 'BERKAHWIN', 'delete_marital' => 0, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')]
        ];
        Marital::insert($maritals);
    }
}
