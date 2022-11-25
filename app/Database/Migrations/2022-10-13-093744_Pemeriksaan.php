<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pemeriksaan extends Migration
{
    public function up()
    {
        $this->forge->addfield([
            'id'            => [ 'type' => 'int', 'constraint' =>10, 'unsigned'=> true,'not null' => true, 'auto_increment' => true],
            'tgl'    => [ 'type' => 'datetime', 'not null' => true],
            'kendaraan_id' => [ 'type' => 'int', 'constraint' => 10, 'not null' => true, 'unsigned'=> true], 
            'kilometer_skr'      => [ 'type' => 'double' ],
            'catatan'  => [ 'type' => 'text'],
            'sa_karyawan_id' => [ 'type' => 'int', 'constraint' =>10, 'unsigned'=> true ],
            'mon_karyawan_id' => [ 'type' => 'int', 'constraint' =>10, 'unsigned'=> true ],
            'tagihan' => [ 'type' => 'double'],
            'statuspemeriksaan_id' => [ 'type' => 'int', 'constraint' =>10, 'unsigned'=> true,'not null' => true], 
            'created_at' => [ 'type' => 'datetime'],
            'updated_at' => [ 'type' => 'datetime'], 
        ]);
        $this->forge->addkey('id');
        $this->forge->createtable('pemeriksaan');
    }

    public function down()
    {
        $this->forge->droptable('pemeriksaan');
    }
}