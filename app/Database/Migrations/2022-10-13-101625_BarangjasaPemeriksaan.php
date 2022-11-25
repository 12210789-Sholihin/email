<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BarangjasaPemeriksaan extends Migration
{
    public function up()
    {
        $this->forge->addfield([
            'id'     => [ 'type' => 'int', 'constraint' =>10, 'unsigned'=> true, 'not null' => true, 'auto_increment' => true],
            'pemeriksaan_id'    => [ 'type' => 'int', 'constraint' =>10, 'not null' => true, 'unsigned'=> true],
            'barang_jasa_id' => [ 'type' => 'int', 'constraint' =>10, 'not null' => true, 'unsigned'=> true],
            'qty' => [ 'type' => 'double', 'not null'=> true, 'unsigned'=> true],
            'harga_satuan' => [ 'type' => 'double', 'not null'=> true, 'unsigned'=> true],
            'created_at' => [ 'type' => 'datetime'],
            'updated_at' => [ 'type' => 'datetime'], 
        ]);
        $this->forge->addkey('id');
        $this->forge->createtable('barangjasapemeriksaan');
    }
    
    public function down()
    {
        $this->forge->droptable('barangjasapemeriksaan');
    }
    }