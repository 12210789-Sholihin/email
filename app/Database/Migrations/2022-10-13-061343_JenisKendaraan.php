<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JenisKendaraan extends Migration
{
    public function up()
    {
        
        $this->forge->addfield([
            'id'  => ['type' => 'int', 'constraint' =>10, 'unsigned'=> true, 'auto_increment' => true],
            'jenis'  => [ 'type' => 'varchar', 'constraint' =>60, 'not null' => true],
            'aktif' => [ 'type' => 'enum("Y", "T")', 'not null' => true], 
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createtable('jeniskendaraan');
    }

    public function down()
    {
        $this->forge->dropTable('jeniskendaraan'); 
    }
}
