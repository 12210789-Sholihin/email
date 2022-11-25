<?php

namespace App\Database\Seeds;

use App\Models\WarnaKendaraan;
use CodeIgniter\Database\Seeder;

class WarnaKendaraanSeeder extends Seeder
{
    public function run()
    {
        $id = (new WarnaKendaraan())->insert([
            'warna' => 'merah metallic',
        ]);
        echo "hasil insert $id";
    }
}

