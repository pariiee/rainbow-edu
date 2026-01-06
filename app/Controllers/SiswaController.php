<?php

namespace App\Controllers;

use App\Models\SiswaModel;
use App\Models\SiswaDetailModel;
use App\Models\SiswaBerkasModel;

class SiswaController extends BaseController
{
    /**
     * Form create siswa
     */
    public function create()
    {
        return view('siswa/create');
    }

    /**
     * Simpan data siswa + detail
     */
    public function store()
    {
        // ===============================
        // VALIDATION (WAJIB)
        // ===============================
        $rules = [
            'nama_lengkap'   => 'required|min_length[3]',
            'gender'         => 'required|in_list[Laki-laki,Perempuan]',
            'consent_konten' => 'required|in_list[Ya,Tidak]'
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        // ===============================
        // INIT MODEL & DB
        // ===============================
        $siswaModel  = new SiswaModel();
        $detailModel = new SiswaDetailModel();
        $db = \Config\Database::connect();

        // ===============================
        // TRANSACTION START
        // ===============================
        $db->transStart();

        // 1. Simpan siswa
        $idSiswa = $siswaModel->insert([
            'nama_lengkap'     => $this->request->getPost('nama_lengkap'),
            'nama_panggilan'   => $this->request->getPost('nama_panggilan'),
            'tanggal_lahir'    => $this->request->getPost('tanggal_lahir'),
            'gender'           => $this->request->getPost('gender'),
            'agama'            => $this->request->getPost('agama'),
            'anak_ke'          => $this->request->getPost('anak_ke'),
            'alamat'           => $this->request->getPost('alamat'),
            'kewarganegaraan'  => $this->request->getPost('kewarganegaraan')
        ]);

        // Jika insert siswa gagal
        if (! $idSiswa) {
            $db->transRollback();
            return redirect()->back()->with('error', 'Gagal menyimpan data siswa');
        }

        // 2. Simpan detail siswa
        $detailModel->insert([
            'id_siswa'               => $idSiswa,
            'nama_ayah'              => $this->request->getPost('nama_ayah'),
            'nama_ibu'               => $this->request->getPost('nama_ibu'),
            'alamat_ortu_wali'       => $this->request->getPost('alamat_ortu_wali'),
            'pekerjaan_ayah'         => $this->request->getPost('pekerjaan_ayah'),
            'kantor_ayah'            => $this->request->getPost('kantor_ayah'),
            'nohp_ayah'              => $this->request->getPost('nohp_ayah'),
            'pekerjaan_ibu'          => $this->request->getPost('pekerjaan_ibu'),
            'kantor_ibu'             => $this->request->getPost('kantor_ibu'),
            'nohp_ibu'               => $this->request->getPost('nohp_ibu'),
            'bahasa'                 => $this->request->getPost('bahasa'),
            'jumlah_saudara_kandung' => $this->request->getPost('jumlah_saudara_kandung'),
            'nama_saudara_kandung'   => $this->request->getPost('nama_saudara_kandung'),
            'usia_saudara_kandung'   => $this->request->getPost('usia_saudara_kandung'),
            'sumber_informasi'       => $this->request->getPost('sumber_informasi')
                                        ? implode(',', $this->request->getPost('sumber_informasi'))
                                        : null,
            'consent_konten'         => $this->request->getPost('consent_konten')
        ]);

        // ===============================
        // TRANSACTION END
        // ===============================
        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()->with('error', 'Gagal menyimpan data');
        }

        return redirect()->to('/siswa/create')->with('success', 'Data siswa berhasil disimpan');
    }

    /**
     * Upload berkas siswa
     */
    public function uploadBerkas($idSiswa)
    {
        $berkasModel = new SiswaBerkasModel();
        $file = $this->request->getFile('berkas');

        if (! $file || ! $file->isValid()) {
            return redirect()->back()->with('error', 'File tidak valid');
        }

        $path = $file->store('uploads/siswa');

        $berkasModel->insert([
            'id_siswa'     => $idSiswa,
            'jenis_berkas' => $this->request->getPost('jenis_berkas'),
            'file_path'    => $path,
            'uploaded_at'  => date('Y-m-d H:i:s')
        ]);

        return redirect()->back()->with('success', 'Berkas berhasil diupload');
    }
}
