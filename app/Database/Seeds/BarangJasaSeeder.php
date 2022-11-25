<?php

namespace App\Database\Seeds;

use App\Models\BarangJasa;
use CodeIgniter\Database\Seeder;

class BarangJasaSeeder extends Seeder
{
    public function run()
    {
        $id = (new BarangJasa())->insert([
            'nama' => 'Mobil',
            'jenis_bj' => 'J',
            'unitsatuan_id' => 'servis',
            'harga_satuan' => '1.000.000',
            'keterangan' => 'Selesai',
            'foto' => '',
        ]);
        echo "hasil insert $id";
    }
}