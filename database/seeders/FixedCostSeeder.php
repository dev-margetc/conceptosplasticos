<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FixedCostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('fixed_costs')->insert([
            [
                'project_id'=> 1,
                'item' => 'arriendo',
                'unit_value' => 2.00,
                'stake' => 50.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'project_id'=> 1,
                'item' => 'electricidad',
                'unit_value' => 1.50,
                'stake' => 30.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'project_id'=> 1,
                'item' => 'agua',
                'unit_value' => 0.75,
                'stake' => 20.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'project_id'=> 1,
                'item' => 'internet',
                'unit_value' => 1.25,
                'stake' => 40.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
