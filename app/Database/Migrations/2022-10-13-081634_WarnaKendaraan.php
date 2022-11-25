<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class WarnaKendaraan extends Migration
{
    public function up()
    {
        $this->forge->addfield([
            'id'            => ['type' => 'int', 'constraint' =>10, 'unsigned'=> true, 'auto_increment' => true],
            'warna'    => [ 'type' => 'varchar', 'constraint' =>100, 'not null' => true],
            
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createtable('warnakendaraan');
    }

    public function down()
    {
        $this->forge->dropTable('warnakendaraan');
    }
}
        
        
