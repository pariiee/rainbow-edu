<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSiswaBerkasTable extends Migration
{
public function up()
{
    $this->forge->addField([
        'id_berkas' => [
            'type' => 'INT',
            'auto_increment' => true
        ],
        'id_siswa' => [
            'type' => 'INT'
        ],
        'jenis_berkas' => [
            'type' => 'ENUM',
            'constraint' => ['KTP_Ortu', 'KK', 'Akta_Lahir']
        ],
        'file_path' => [
            'type' => 'VARCHAR',
            'constraint' => 255
        ],
        'uploaded_at' => [
            'type' => 'DATETIME',
            'null' => true
        ]
    ]);

    $this->forge->addKey('id_berkas', true);
    $this->forge->addForeignKey('id_siswa', 'siswa', 'id_siswa', 'CASCADE', 'CASCADE');
    $this->forge->createTable('siswa_berkas');
}


    public function down()
    {
        //
    }
}
