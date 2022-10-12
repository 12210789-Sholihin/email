<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pustakawan extends Migration
{
    public function up()
    {
        $this ->forge->addField([
            'id'    => ['type' => 'int', 'constraint'=>10, 'unsigned'=>true, 'auto_increment' =>true ],
            'nama'  => ['type' => 'varchar', 'constraint' =>80, 'null'=>false],
            'gender'  => ['type' => 'enum("L","P")','null'=>true],
            'email'  => ['type' => 'varchar', 'constraint' =>128, 'null'=>true],
            'sandi'  => ['type' => 'varchar', 'constraint' =>60, 'null'=>true],
            'created_at'  => ['type' => 'datetime', 'null'=>true],
            'updated_at'  => ['type' => 'datetime', 'null'=>true],
            'deleted_at'  => ['type' => 'datetime', 'null'=>true],
        ]);
        $this ->forge->addPrimary('id');
        $this ->forge->createTable('pengguna');
    }

    public function down()
    {
        $this ->forge->dropTable('pengguna');
    }
}
