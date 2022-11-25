<?php

namespace App\Database\Seeds;

use App\Models\MetodeBayar;
use CodeIgniter\Database\Seeder;

class MetodeBayarSeeder extends Seeder
{
    public function run()
    {
        $id = (new MetodeBayar())->insert([
            'metodebayar' => 'Tunai',
            'keterangan' => 'Lunas',
            'aktif' => 'Y',
        ]);
        echo "hasil insert $id";
    }
}