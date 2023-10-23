<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TahunPeriode extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true, 'auto_increment' => true],
            'tahun' => ['type' => 'VARCHAR', 'constraint' => 10],
            'periode' => ['type' => 'VARCHAR', 'constraint' => 50],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('tahun_periode');
    }

    public function down()
    {
        $this->forge->dropTable('tahun_periode');
    }
}
