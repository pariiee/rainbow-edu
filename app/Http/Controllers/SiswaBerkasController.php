<?php

namespace App\Http\Controllers;

use App\Models\SiswaBerkas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaBerkasController extends Controller
{
    public function create($id_siswa)
    {
        $siswa = Siswa::findOrFail($id_siswa);
        return view('siswa_berkas.create', compact('siswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_siswa'   => 'required|exists:siswa,id_siswa',
            'nama_berkas'=> 'required|string|max:100',
            'file'       => 'required|file',
            'keterangan' => 'nullable|string',
        ]);

        $path = $request->file('file')->store('berkas_siswa', 'public');

        $berkas = SiswaBerkas::create([
            'id_siswa'   => $request->id_siswa,
            'nama_berkas'=> $request->nama_berkas,
            'file_path'  => $path,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()
            ->route('siswa.show', $request->id_siswa)
            ->with('success', 'Berkas berhasil diupload');
    }

    public function destroy($id)
    {
        $berkas = SiswaBerkas::findOrFail($id);
        $berkas->delete();

        return back()->with('success', 'Berkas berhasil dihapus');
    }
}
