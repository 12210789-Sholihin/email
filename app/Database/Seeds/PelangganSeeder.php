<?php

namespace App\Database\Seeds;

use App\Models\Pelanggan;
use CodeIgniter\Database\Seeder;

class PelangganSeeder extends Seeder
{
    public function run()
    {
        $id = (new Pelanggan())->insert([
            'nama_depan' => 'Sholihin',
            'nama_belakang' => 'Lihin',
            'gender' => 'L',
            'alamat' => 'Siantan',
            'kota' => 'Pontianak',
            'notelp' => '089543667893',
            'hp' => '62877969',
            'email' => 'Sholihin10@gmail.com',
            'tgl_daftar' => '2022-10-18',
        ]);
        echo "hasil insert $id";
    }
}
