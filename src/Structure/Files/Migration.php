<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Migration_REPLACE_NAME_HERE extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(
            [
                'id' => [
                    'type' => 'INT',
                    'constraint' => 10,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ],
                'created_at' => [
                    'type' => 'TIMESTAMP',
                    'null' => TRUE
                ],
                'updated_at' => [
                    'type' => 'TIMESTAMP',
                    'null' => TRUE
                ],
            ]
        );

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table("REPLACE_NAME_TABLE",TRUE);

    }

    public function down()
    {
        $this->dbforge->drop_table("REPLACE_NAME_TABLE");
    }

}