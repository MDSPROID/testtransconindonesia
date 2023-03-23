<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Transaction_Details extends CI_Migration {
    public function __construct(){
        $this->load->dbforge();
        $this->load->database();
    }

    public function up(){
        $this->dbforge->add_field(array(
            'id' => array(
                    'type'              => 'INT',
                    'constraint'        => 5,
                    'unsigned'          => TRUE,
                    'auto_increment'    => TRUE
            ),
            'transaction_id' => array(
                    'type'          => 'INT',
                    'constraint'    => '10',
            ),
            'item' => array(
                    'type'          => 'varchar',
                    'constraint'    => '100',
            ),
            'quantity' => array(
                'type'          => 'INT',
                'constraint'    => '10',
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('transaction_details');
    }

    public function down(){
        $this->dbforge->drop_table('transaction_details');
    }
}