<?php

namespace App\Database\Seeds;

use App\Models\StatusPemeriksaan;
use CodeIgniter\Database\Seeder;

class StatusPemeriksaanSeeder extends Seeder
{
    public function run()
    {
        $id = (new StatusPemeriksaan())->insert([
            'status' => 'Diperiksa',
            'urutan' => '2',
            'aktif' => 'Y',
        ]);
        echo "hasil insert $id";
    }
}

