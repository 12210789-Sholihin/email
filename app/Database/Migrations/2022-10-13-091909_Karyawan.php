<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Karyawan extends Migration
{
    public function up()
    {
        
        $this->forge->addfield([
            'id'            => [ 'type' => 'int', 'constraint' =>10, 'unsigned'=> true,'not null' => true, 'auto_increment' => true],
            'nama_lengkap'    => [ 'type' => 'varchar', 'constraint' => 60, 'not null' => true],
            'email' => [ 'type' => 'varchar', 'constraint' => 255, 'not null' => true], 
            'nohp'      => [ 'type' => 'varchar', 'constraint' =>16 ],
            'alamat'  => [ 'type' => 'varchar', 'constraint' =>255 ],
            'kota' => [ 'type' => 'varchar', 'constraint' =>50 ],
            'sandi' => [ 'type' => 'varchar', 'constraint' =>60],
            'token_reset' => [ 'type' => 'varchar', 'constraint' =>10],
            'level' => [ 'type' => 'enum("MAN", "ADM", "SA", "MON")' ],
            'foto' => [ 'type' => 'varinary', 'constraint' =>255], 
            'created_at' => [ 'type' => 'datetime'],
            'updated_at' => [ 'type' => 'datetime'],
            'last_login' => [ 'type' => 'datetime'], 
        ]);
        $this->forge->addkey('id');
        $this->forge->createtable('karyawan');
    }

    public function down()
    {
        $this->forge->droptable('karyawan');
    }
}