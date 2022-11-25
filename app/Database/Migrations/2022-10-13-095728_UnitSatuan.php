<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UnitSatuan extends Migration
{
    public function up()
    {
        $this->forge->addfield([
            'id'        => ['type' => 'int', 'constraint' =>10, 'unsigned'=> true, 'not null' => true],
            'satuan'    => [ 'type' => 'varchar', 'constraint' =>100, 'not null' => true],
            
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createtable('unitsatuan');
    }

    public function down()
    {
        $this->forge->dropTable('unitsatuan');
    }
}
        
        
