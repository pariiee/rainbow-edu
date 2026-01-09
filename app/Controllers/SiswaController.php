<?php

namespace App\Controllers;

use App\Models\SiswaModel;
use App\Models\SiswaDetailModel;
use CodeIgniter\Database\Exceptions\DatabaseException;

class SiswaController extends BaseController
{
    public function index()
    {
        $model = new SiswaModel();
        return view('siswa/index', [
            'siswa' => $model->findAll()
        ]);
    }

    public function create()
    {
        return view('siswa/create');
    }

    public function show($id)
{
    $siswaModel  = new SiswaModel();
    $detailModel = new SiswaDetailModel();

    $siswa = $siswaModel->find($id);

    if (! $siswa) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Data siswa tidak ditemukan');
    }

    $detail = $detailModel->where('id_siswa', $id)->first();

    return view('siswa/show', [
        'siswa'  => $siswa,
        'detail' => $detail   // ⬅️ INI YANG KURANG
    ]);
}



    public function edit($id)
    {
        $siswaModel  = new SiswaModel();
        $detailModel = new SiswaDetailModel();

        $siswa  = $siswaModel->find($id);
        $detail = $detailModel->where('id_siswa', $id)->first();

        if (! $siswa) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('siswa/edit', compact('siswa', 'detail'));
    }

    public function store()
    {
        $db = \Config\Database::connect();
        $db->transBegin();

        $siswaModel  = new SiswaModel();
        $detailModel = new SiswaDetailModel();

        $rules = [
            'nama_lengkap'   => 'required|min_length[3]',
            'gender'         => 'required|in_list[Laki-laki,Perempuan]',
            'tanggal_lahir'  => 'required|valid_date',
            'consent_konten' => 'required|in_list[Ya,Tidak]'
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        try {
            $siswaModel->insert([
                'nama_lengkap'    => $this->request->getPost('nama_lengkap'),
                'nama_panggilan'  => $this->request->getPost('nama_panggilan'),
                'tanggal_lahir'   => $this->request->getPost('tanggal_lahir'),
                'gender'          => $this->request->getPost('gender'),
                'agama'           => $this->request->getPost('agama'),
                'anak_ke'         => $this->request->getPost('anak_ke'),
                'alamat'          => $this->request->getPost('alamat'),
                'kewarganegaraan' => $this->request->getPost('kewarganegaraan')
            ]);

            $idSiswa = $siswaModel->getInsertID();

            $detailModel->insert([
                'id_siswa'               => $idSiswa,
                'nama_ayah'              => $this->request->getPost('nama_ayah'),
                'nama_ibu'               => $this->request->getPost('nama_ibu'),
                'alamat_ortu_wali'       => $this->request->getPost('alamat_ortu_wali'),
                'pekerjaan_ayah'         => $this->request->getPost('pekerjaan_ayah'),
                'nohp_ayah'              => $this->request->getPost('nohp_ayah'),
                'pekerjaan_ibu'          => $this->request->getPost('pekerjaan_ibu'),
                'nohp_ibu'               => $this->request->getPost('nohp_ibu'),
                'bahasa'                 => $this->request->getPost('bahasa'),
                'jumlah_saudara_kandung' => $this->request->getPost('jumlah_saudara_kandung'),
                'sumber_informasi'       => implode(',', (array)$this->request->getPost('sumber_informasi')),
                'consent_konten'         => $this->request->getPost('consent_konten')
            ]);

            $db->transCommit();

            return redirect()->to('/siswa')->with('success', 'Data siswa berhasil disimpan');

        } catch (DatabaseException $e) {
            $db->transRollback();
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data');
        }
    }

    public function update($id)
    {
        $db = \Config\Database::connect();
        $db->transBegin();

        $siswaModel  = new SiswaModel();
        $detailModel = new SiswaDetailModel();

        try {
            $siswaModel->update($id, [
                'nama_lengkap'    => $this->request->getPost('nama_lengkap'),
                'nama_panggilan'  => $this->request->getPost('nama_panggilan'),
                'tanggal_lahir'   => $this->request->getPost('tanggal_lahir'),
                'gender'          => $this->request->getPost('gender'),
                'agama'           => $this->request->getPost('agama'),
                'anak_ke'         => $this->request->getPost('anak_ke'),
                'alamat'          => $this->request->getPost('alamat'),
                'kewarganegaraan' => $this->request->getPost('kewarganegaraan')
            ]);

            $detailModel->where('id_siswa', $id)->set([
                'nama_ayah'        => $this->request->getPost('nama_ayah'),
                'nama_ibu'         => $this->request->getPost('nama_ibu'),
                'alamat_ortu_wali' => $this->request->getPost('alamat_ortu_wali'),
                'consent_konten'   => $this->request->getPost('consent_konten')
            ])->update();

            $db->transCommit();

            return redirect()->to('/siswa')->with('success', 'Data berhasil diperbarui');

        } catch (\Exception $e) {
            $db->transRollback();
            return redirect()->back()->withInput()->with('error', 'Gagal update data');
        }
    }

    public function delete($id)
    {
        $db = \Config\Database::connect();
        $db->transBegin();

        try {
            (new SiswaDetailModel())->where('id_siswa', $id)->delete();
            (new SiswaModel())->delete($id);

            $db->transCommit();

            return redirect()->to('/siswa')->with('success', 'Data siswa dihapus');

        } catch (\Exception $e) {
            $db->transRollback();
            return redirect()->to('/siswa')->with('error', 'Gagal menghapus data');
        }
    }
}
