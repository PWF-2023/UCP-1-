<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kandidat;

class KandidatController extends Controller
{
    // Fungsi aksi untuk menampilkan halaman tambah kandidat
    public function create()
    {
        return view('create');
    }

    // Fungsi aksi untuk menyimpan data kandidat dari form
    public function store(Request $request)
    {
        // Validasi data yang dikirimkan dari form
        $request->validate([
            'nama' => 'required|string|max:255',
            'partai' => 'required|string|max:255',
            'foto' => 'required|image|mimes:jpeg,png,webp|max:2048',
            'status' => 'required|in:menang,kalah',
            'total_vote' => 'required|integer|min:0',
        ]);

        // Upload foto dan dapatkan nama file yang diunggah
        $fotoPath = $request->file('foto')->store('kandidat_foto');

        // Simpan data kandidat ke database
        Kandidat::create([
            'nama' => $request->nama,
            'partai' => $request->partai,
            'foto' => $fotoPath,
            'status' => $request->status,
            'total_vote' => $request->total_vote,
        ]);

        // Redirect ke halaman setelah data berhasil disimpan
        return redirect()->route('kandidat.index')->with('success', 'Data kandidat berhasil disimpan.');
    }
}
