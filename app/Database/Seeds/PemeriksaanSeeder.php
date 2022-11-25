<?php

namespace App\Database\Seeds;

use App\Models\Pemeriksaan;
use CodeIgniter\Database\Seeder;

class PemeriksaanSeeder extends Seeder
{
    public function run()
    {
        $id = (new Pemeriksaan())->insert([
            'tgl' => '2022-10-18',
            'kendaraan_id' => 1,
            'kilometer_skr' => '',
            'catatan' => 'tidak ada',
            'sa_karyawan_id' => '',
            'mon_karyawan_id' => '',
            'tagihan' => '1.000.000',
            'statuspemeriksaan_id' => '',
        ]);
        echo "hasil insert $id";
    }
}