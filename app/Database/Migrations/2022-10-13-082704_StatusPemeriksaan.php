<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class StatusPemeriksaan extends Migration
{
    public function up()
    {
        
        $this->forge->addfield([
            'id'     => ['type' => 'int', 'constraint' =>10, 'unsigned'=> true, 'auto_increment' => true],
            'status'    => [ 'type' => 'varchar', 'constraint' =>50, 'not null' => true],
            'urutan' => [ 'type' => 'int', 'constraint' =>10, 'default' => "1", 'unsigned'=> true],
            'aktif' => [ 'type' => 'enum("Y", "T")', 'default' => "Y"],

        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createtable('statuspemeriksaan');
    }

    public function down()
    {
        $this->forge->dropTable('statuspemeriksaan');
    }
}