<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Students extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' =>[ 
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'name' =>[ 
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'age' => [
                'type' => 'INT',
                'constraint' => 3,
            ],
            
        ]);

      
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('students');
    }

    public function down()
    {
        $this->forge->dropTable('students');
    }
}
