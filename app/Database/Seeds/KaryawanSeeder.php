<?php

namespace App\Database\Seeds;

use App\Models\Karyawan;
use CodeIgniter\Database\Seeder;

class KaryawanSeeder extends Seeder
{
    public function run()
    {
        $id = (new Karyawan())->insert([
            'nama_lengkap' => 'Marsianus',
            'email' => 'marsianus@gmail.com',
            'nohp' => '089564378932',
            'alamat' => 'Adisucipto',
            'kota' => 'Pontianak',
            'sandi' => '12345',
            'token_reset' => 'qwerty',
            'level' => 'MAN',
            'foto' => 'hgvgyhvgh',
        ]);
        echo "hasil insert $id";
    }
}
