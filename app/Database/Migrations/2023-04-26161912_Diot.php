    <?php

    namespace App\Database\Migrations;

    use CodeIgniter\Database\Migration;

    class Diot extends Migration
    {
        public function up()
        {
            // Diot
            $this->forge->addField([
                'id'                    => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
                'period'             => ['type' => 'varchar', 'constraint' => 4, 'null' => true],
                'RFC'             => ['type' => 'varchar', 'constraint' => 15, 'null' => true],
                'beneficiary'             => ['type' => 'varchar', 'constraint' => 512, 'null' => true],
                'base16'             => ['type' => 'decimal', 'constraint' => 18, 'null' => true],
                'IVA16'             => ['type' => 'decimal', 'constraint' => 18, 'null' => true],
                'rate0'             => ['type' => 'decimal', 'constraint' => 18, 'null' => true],
                'total'             => ['type' => 'decimal', 'constraint' => 18, 'null' => true],
                'uuidFile'             => ['type' => 'varchar', 'constraint' => 16, 'null' => true],

                'created_at'       => ['type' => 'datetime', 'null' => true],
                'updated_at'       => ['type' => 'datetime', 'null' => true],
                'deleted_at'       => ['type' => 'datetime', 'null' => true],
            ]);
            $this->forge->addKey('id', true);
            $this->forge->createTable('diot', true);
        }
        public function down()
        {
            $this->forge->dropTable('diot', true);
        }
    }
