<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSiswaTable extends Migration
{
public function up()
{
    $this->forge->addField([
        'id_siswa' => [
            'type' => 'INT',
            'auto_increment' => true
        ],
        'nama_lengkap' => [
            'type' => 'VARCHAR',
            'constraint' => 100
        ],
        'nama_panggilan' => [
            'type' => 'VARCHAR',
            'constraint' => 50,
            'null' => true
        ],
        'tanggal_lahir' => [
            'type' => 'DATE',
            'null' => true
        ],
        'gender' => [
            'type' => 'ENUM',
            'constraint' => ['Laki-laki', 'Perempuan']
        ],
        'agama' => [
            'type' => 'VARCHAR',
            'constraint' => 20
        ],
        'anak_ke' => [
            'type' => 'INT'
        ],
        'alamat' => [
            'type' => 'TEXT'
        ],
        'kewarganegaraan' => [
            'type' => 'VARCHAR',
            'constraint' => 50
        ],
        'created_at' => [
            'type' => 'DATETIME',
            'null' => true
        ]
    ]);

    $this->forge->addKey('id_siswa', true);
    $this->forge->createTable('siswa');
}


    public function down()
    {
        //
    }
}
