<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kendaraan extends Migration
{
    public function up()
    {
        
        $this->forge->addfield([
            'id'            => ['type' => 'int', 'constraint' =>10, 'unsigned'=> true, 'auto_increment' => true],
            'pelanggan_id'    => [ 'type' => 'int', 'contraint' => 10, 'not null' => true, 'unsigned' => true],
            'jeniskendaraan_id' => [ 'type' => 'int', 'constrain' => 10, 'not null' => true, 'unsigned' => true], 
            'no_pol'      => [ 'type' => 'varchar', 'constraint' =>12 ],
            'tahun'  => [ 'type' => 'year', 'constraint' =>4 ],
            'warankendaraan_id' => [ 'type' => 'int', 'constraint' =>10, 'unsigned' =>true],
            'created_at' => [ 'type' => 'datetime'],
            'updated_at' => [ 'type' => 'datetime'],
            'deleted_at' => [ 'type' => 'datetime'], 
        ]);
        $this->forge->addkey('id');
        $this->forge->createtable('kendaraan');
    }

    public function down()
    {
        $this->forge->droptable('kendaraan');
    }
}