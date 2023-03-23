<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Transactions extends CI_Migration {
    public function __construct(){
        $this->load->dbforge();
        $this->load->database();
    }

    public function up(){
        $this->dbforge->add_field(array(
            'id' => array(
                    'type' => 'INT',
                    'constraint' => 5,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
            ),
            'no_transaction' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '10',
            ),
            'transaction_date' => array(
                    'type' => 'date',
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('transactions');
    }

    public function down(){
        $this->dbforge->drop_table('transactions');
    }
}