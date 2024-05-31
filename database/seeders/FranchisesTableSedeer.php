<?php

namespace Database\Seeders;

use App\Models\Franchise;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FranchisesTableSedeer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Franchise::factory()->count(50)->create();
    }
}
