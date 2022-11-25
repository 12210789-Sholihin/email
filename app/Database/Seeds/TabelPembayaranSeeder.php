<?php

namespace App\Database\Seeds;

use App\Models\Pembayaran;
use CodeIgniter\Database\Seeder;

class TabelPembayaranSeeder extends Seeder
{
    public function run()
    {
        $id = (new Pembayaran())->insert([
            'pemeriksaan_id' => 2,
            'tgl_bayar' => '2022-10-18',
            'metode_bayar_id' => 1,
            'dibayaroleh' => 'Ricky',
            'catatan' => 'Lunas',
            'karyawan_id' =>1,
            'total_bayar' => 1000000,
        ]);
        echo "hasil insert $id";
    }
}