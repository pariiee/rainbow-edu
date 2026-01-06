<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSiswaDetailTable extends Migration
{
public function up()
{
    $this->forge->addField([
        'id_detail' => [
            'type' => 'INT',
            'auto_increment' => true
        ],
        'id_siswa' => [
            'type' => 'INT'
        ],
        'nama_ayah' => ['type' => 'VARCHAR', 'constraint' => 100],
        'nama_ibu' => ['type' => 'VARCHAR', 'constraint' => 100],
        'alamat_ortu_wali' => ['type' => 'TEXT'],
        'pekerjaan_ayah' => ['type' => 'VARCHAR', 'constraint' => 100],
        'kantor_ayah' => ['type' => 'VARCHAR', 'constraint' => 100],
        'nohp_ayah' => ['type' => 'VARCHAR', 'constraint' => 20],
        'pekerjaan_ibu' => ['type' => 'VARCHAR', 'constraint' => 100],
        'kantor_ibu' => ['type' => 'VARCHAR', 'constraint' => 100],
        'nohp_ibu' => ['type' => 'VARCHAR', 'constraint' => 20],
        'bahasa' => ['type' => 'VARCHAR', 'constraint' => 100],
        'jumlah_saudara_kandung' => ['type' => 'INT'],
        'nama_saudara_kandung' => ['type' => 'TEXT'],
        'usia_saudara_kandung' => ['type' => 'TEXT'],
        'sumber_informasi' => [
            'type' => 'SET',
            'constraint' => ['Instagram', 'Facebook', 'Teman', 'Google', 'Spanduk', 'Lainnya']
        ],
        'consent_konten' => [
            'type' => 'ENUM',
            'constraint' => ['Ya', 'Tidak']
        ]
    ]);

    $this->forge->addKey('id_detail', true);
    $this->forge->addForeignKey('id_siswa', 'siswa', 'id_siswa', 'CASCADE', 'CASCADE');
    $this->forge->createTable('siswa_detail');
}


    public function down()
    {
        //
    }
}
