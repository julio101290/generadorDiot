<?php

    namespace App\Database\Migrations;

    use CodeIgniter\Database\Migration;

    class Settingsrfc extends Migration
    {
        public function up()
        {
            // Settingsrfc
            $this->forge->addField([
                'id'                    => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
                'RFC'             => ['type' => 'varchar', 'constraint' => 16, 'null' => true],
                'thirdParty'             => ['type' => 'int', 'constraint' => 11, 'null' => true],
                'typeOperation'             => ['type' => 'int', 'constraint' => 11, 'null' => true],
            'created_at' => ['type' => 'datetime', 'null' => true],
                'updated_at'       => ['type' => 'datetime', 'null' => true],
                'deleted_at'       => ['type' => 'datetime', 'null' => true],
            ]);
            $this->forge->addKey('id', true);
            $this->forge->createTable('settingsrfc', true);
        }                                   
        public function down()
        {
            $this->forge->dropTable('settingsrfc', true);
        }
    }
