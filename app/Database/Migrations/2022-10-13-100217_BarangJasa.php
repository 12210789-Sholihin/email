<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BarangJasa extends Migration
{
    public function up()
    {
        $this->forge->addfield([
            'id'     => ['type' => 'int', 'constraint' =>10, 'unsigned'=> true, 'not null' => true, 'auto_increment' => true],
            'nama'    => [ 'type' => 'varchar', 'constraint' =>100, 'not null' => true],
            'jenis_bj' => [ 'type' => 'enum("B", "J")'],
            'unitsatuan_id' => [ 'type' => 'int', 'constraint' =>10, 'unsigned'=> true],
            'harga_satuan' => [ 'type' => 'double', 'unsigned'=> true],
            'keterangan' => [ 'type' => 'text'],
            'foto' => [ 'type' => 'varbinary', 'constraint' =>255],
            'created_at' => [ 'type' => 'datetime'],
            'updated_at' => [ 'type' => 'datetime'], 
            'deleted_at' => ['type' => 'datetime'],
        ]);
        $this->forge->addkey('id');
        $this->forge->createtable('barangjasa');
    }
    
    public function down()
    {
        $this->forge->droptable('barangjasa');
    }
    }