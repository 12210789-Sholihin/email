<?php

namespace App\Database\Seeds;

use App\Models\JenisKendaraan;
use CodeIgniter\Database\Seeder;

class JenisKendaraanSeeder extends Seeder
{
    public function run()
    {
        $id = (new JenisKendaraan())->insert([
            'jenis' => 'Mobil Sedan',
            'aktif' => 'Y',
        ]);
        echo "hasil insert $id";
    }
}
