<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'             => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'first_name'     => ['type' => 'VARCHAR', 'constraint' => 100],
            'last_name'      => ['type' => 'VARCHAR', 'constraint' => 100],
            'email'          => ['type' => 'VARCHAR', 'constraint' => 150],
            'address'        => ['type' => 'TEXT'],
            'city'           => ['type' => 'VARCHAR', 'constraint' => 100],
            'pin_code'       => ['type' => 'VARCHAR', 'constraint' => 20],
            'country'        => ['type' => 'VARCHAR', 'constraint' => 100],
            'phone'          => ['type' => 'VARCHAR', 'constraint' => 20],
            'payment_method' => ['type' => 'VARCHAR', 'constraint' => 50],
            'subtotal'       => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'tax'            => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'total'          => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'created_at'     => ['type' => 'DATETIME', 'null' => true],
            'updated_at'     => ['type' => 'DATETIME', 'null' => true],
        ]);
        
        $this->forge->addKey('id', true);
        $this->forge->createTable('orders');
    }

    public function down()
    {
        $this->forge->dropTable('orders');
    }
}