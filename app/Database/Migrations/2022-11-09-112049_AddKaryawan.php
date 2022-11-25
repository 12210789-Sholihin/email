<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddKaryawan extends Migration
{
    public function up()
    {
        $this->forge->addfield([
            'id'            => [ 'type' => 'int', 'constraint' =>10, 'unsigned'=> true,'not null' => true, 'auto_increment' => true],
            'nama_lengkap'    => [ 'type' => 'varchar', 'constraint' => 60, 'not null' => true],
            'email' => [ 'type' => 'varchar', 'constraint' => 255, 'not null' => true], 
            'nohp'      => [ 'type' => 'varchar', 'constraint' =>16, 'not null' => true ],
            'alamat'  => [ 'type' => 'varchar', 'constraint' =>255 , 'not null' => true],
            'kota' => [ 'type' => 'varchar', 'constraint' =>50 , 'not null' => true],
            'sandi' => [ 'type' => 'varchar', 'constraint' =>60, 'not null' => true],
            'token_reset' => [ 'type' => 'varchar', 'constraint' =>10, 'not null' => true],
            'level' => [ 'type' => 'enum("MAN", "ADM", "SA", "MON")' , 'not null' => true],
            'foto' => [ 'type' => 'varbinary', 'constraint' =>255, 'not null' => true], 
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
