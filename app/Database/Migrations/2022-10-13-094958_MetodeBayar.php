<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MetodeBayar extends Migration
{
    public function up()
    {
        $this->forge->addfield([
        'id'     => ['type' => 'int', 'constraint' =>10, 'unsigned'=> true, 'auto_increment' => true],
        'metodebayar'    => [ 'type' => 'varchar', 'constraint' =>50, 'not null' => true],
        'keterangan' => [ 'type' => 'text'],
        'aktif' => [ 'type' => 'enum("Y", "T")'],
        'created_at' => [ 'type' => 'datetime'],
        'updated_at' => [ 'type' => 'datetime'], 
        'deleted_at' => ['type' => 'datetime'],
    ]);
    $this->forge->addkey('id');
    $this->forge->createtable('metodebayar');
}

public function down()
{
    $this->forge->droptable('metodebayar');
}
}