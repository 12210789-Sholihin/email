<?php

namespace App\Database\Seeds;

use App\Models\Kendaraan;
use CodeIgniter\Database\Seeder;

class KendaraanSeeder extends Seeder
{
    public function run()
    {
        $id = (new Kendaraan())->insert([
            'pelanggan_id' => 1,
            'jeniskendaraan_id' => 'Mobil Sedan',
            'no_pol' => '1255',
            'tahun' => '2020',
            'warnakendaraan_id' => 'merah metallic',
        ]);
        echo "hasil insert $id";
    }
}
