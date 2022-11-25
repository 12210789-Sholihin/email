<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TabelPembayaran extends Migration
{
    public function up()
    {
        $this->forge->addfield([
            'id'     => ['type' => 'int', 'constraint' =>10, 'unsigned'=> true, 'not null' => true, 'auto_increment' => true],
            'pemeriksaan_id'    => [ 'type' => 'int', 'constraint' =>10, 'unsigned'=> true, 'not null' => true],
            'tgl_bayar' => [ 'type' => 'datetime'],
            'metode_bayar_id' => [ 'type' => 'int', 'constraint' =>10, 'unsigned'=> true, 'not null' => true],
            'dibayaroleh' => [ 'type' => 'varchar', 'constraint' =>100 ],
            'catatan' => [ 'type' => 'text'],
            'karyawan_id' => [ 'type' => 'int', 'constraint' =>10, 'not null'=> true, 'unsigned' => true ],
            'total_bayar' => [ 'type' => 'double'],
            'created_at' => [ 'type' => 'datetime'],
            'updated_at' => [ 'type' => 'datetime'], 
        ]);
        $this->forge->addkey('id');
        $this->forge->createtable('tabelpembayaran');
    }
    
    public function down()
    {
        $this->forge->droptable('tabelpembayaran');
    }
    }