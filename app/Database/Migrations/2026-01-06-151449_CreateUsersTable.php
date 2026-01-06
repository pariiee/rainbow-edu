<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
{
    $this->forge->addField([
        'id_user' => [
            'type' => 'INT',
            'auto_increment' => true
        ],
        'username' => [
            'type' => 'VARCHAR',
            'constraint' => 50,
            'unique' => true
        ],
        'password' => [
            'type' => 'VARCHAR',
            'constraint' => 255
        ],
        'otp' => [
            'type' => 'VARCHAR',
            'constraint' => 10,
            'null' => true
        ],
        'created_at' => [
            'type' => 'DATETIME',
            'null' => true
        ]
    ]);

    $this->forge->addKey('id_user', true);
    $this->forge->createTable('users');
}


    public function down()
    {
        //
    }
}
