<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pelanggan extends Migration
{
    public function up()
    {
        
        $this->forge->addfield([
            'id'            => ['type' => 'int', 'constraint' =>10, 'unsigned'=> true, 'auto_increment' => true],
            'nama_depan'    => [ 'type' => 'varchar', 'constraint' => 50, 'not null' => true],
            'nama_belakang' => [ 'type' => 'varchar', 'constraint' => 50, 'not null' => true],
            'gender'        => [ 'type' => 'enum("L", "P")', 'not null' => true], 
            'alamat'      => [ 'type' => 'varchar', 'constraint' =>100, 'not null' => true],
            'kota'  => [ 'type' => 'varchar', 'constraint' =>50, 'not null' => true],
            'notelp' => [ 'type' => 'varchar', 'constraint' =>15, 'not null' => true],
            'hp' => [ 'type' => 'varchar', 'constraint' =>15, 'not null' => true],
            'email' => [ 'type' => 'varchar', 'constraint' =>128, 'not null' => true],
            'tgl_daftar' => [ 'type' => 'date'],
            'created_at' => [ 'type' => 'datetime'],
            'updated_at' => [ 'type' => 'datetime'],
            'deleted_at' => [ 'type' => 'datetime'],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createtable('pelanggan');
    }

    public function down()
    {
        $this->forge->dropTable('pelanggan');
    }
}
