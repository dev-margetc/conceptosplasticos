<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BusinessType;
use App\Models\CustomerType;

class BusinessTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bricksBlocks = BusinessType::create(['description' => 'Negocios Bricks & Blocks (Producto)']);
        $conceptosPlasticos = BusinessType::create(['description' => 'Negocios Conceptos Plasticos (Industria)']);
        $theWay = BusinessType::create(['description' => 'Negocios The Way (Proyectos)']);

        $bricksBlocksCustomerTypes = [
            'NGO',
            'Private sector',
            'Gobierno',
            'Business Development',
            'Constructors',
            'Natural person',
            'Distributor',
        ];

        $conceptosPlasticosCustomerTypes = [
            'NGO',
            'Plastic sector',
            'Private sector',
            'Gobierno',
            'Business Development',
            'Private investor',
            'Natural person',
            'Distributor',
        ];

        $theWayCustomerTypes = [
            'NGO',
            'Plastic sector',
            'Private sector',
            'Gobierno',
            'Business Development',
            'Private investor',
        ];

        foreach ($bricksBlocksCustomerTypes as $type) {
            CustomerType::create(['business_type_id' => $bricksBlocks->id, 'name' => $type]);
        }

        foreach ($conceptosPlasticosCustomerTypes as $type) {
            CustomerType::create(['business_type_id' => $conceptosPlasticos->id, 'name' => $type]);
        }

        foreach ($theWayCustomerTypes as $type) {
            CustomerType::create(['business_type_id' => $theWay->id, 'name' => $type]);
        }
    }
}
