<?php

namespace App\Database\Seeds;

use App\Models\BarangjasaPemeriksaan;
use CodeIgniter\Database\Seeder;

class BarangjasaPemeriksaanSeeder extends Seeder
{
    public function run()
    {
        $id = (new BarangjasaPemeriksaan())->insert([
            'pemeriksaan_id' => '',
            'barang_jasa_id' => 'Mobil',
            'qty' => '',
            'harga_satuan' => '1.000.000',
        ]);
        echo "hasil insert $id";
    }
}
    