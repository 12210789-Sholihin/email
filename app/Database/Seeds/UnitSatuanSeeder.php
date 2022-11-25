<?php

namespace App\Database\Seeds;

use App\Models\UnitSatuan;
use CodeIgniter\Database\Seeder;

class UnitSatuanSeeder extends Seeder
{
    public function run()
    {
        $id = (new UnitSatuan())->insert([
            'satuan' => 'Liter',
        ]);
        echo "hasil insert $id";
    }
}