<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCartItemsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            // We removed the 'unsigned' strictness here to prevent the Error 150 mismatch
            'cart_id'    => ['type' => 'INT', 'constraint' => 11],
            'product_id' => ['type' => 'INT', 'constraint' => 11],
            'qty'        => ['type' => 'INT', 'constraint' => 11, 'default' => 1],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        
        $this->forge->addKey('id', true);
        // Strict Database Foreign Keys removed to prevent Error 150.
        // Data integrity will be handled by our CI4 Models instead.
        $this->forge->createTable('cart_items');
    }

    public function down()
    {
        $this->forge->dropTable('cart_items');
    }
}