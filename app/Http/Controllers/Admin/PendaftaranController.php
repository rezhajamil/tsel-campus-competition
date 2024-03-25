<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\Proposal;
use App\Models\Peserta;

class PendaftaranController extends Controller
{
    // Menampilkan semua data pendaftaran
    public function index(Request $request)
{
    // Menghitung jumlah pendaftaran
    $jumlah_pendaftaran = Pendaftaran::count();

    // Menghitung jumlah peserta
    $jumlah_peserta = Peserta::count();

    // Menghitung jumlah proposal dengan status "Publish"
    $jumlah_publish = Proposal::where('status', 'Publish')->count();

    // Menghitung jumlah proposal dengan status "Proses"
    $jumlah_proses = Proposal::where('status', 'Proses')->count();

    // Mengambil semua data pendaftaran
    $pendaftarans = Pendaftaran::all();

    // Jika terdapat query string proposal_id
    if ($request->filled('proposal_id')) {
        // Lakukan pencarian berdasarkan proposal_id
        $proposal_id = $request->input('proposal_id');
        $pendaftarans = Pendaftaran::whereHas('proposal', function ($query) use ($proposal_id) {
            $query->where('id_proposal', $proposal_id);
        })->get();
    }

    return view('dashboard-admin2', compact('pendaftarans', 'jumlah_pendaftaran', 'jumlah_peserta', 'jumlah_publish', 'jumlah_proses'));
}


    // Menampilkan form untuk membuat pendaftaran baru
    public function create()
    {
        // Jika diperlukan, Anda dapat menambahkan logika untuk menyiapkan form di sini
        return view('create-pendaftaran');
    }

    // Menyimpan pendaftaran baru ke dalam database
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'kelompok_id' => 'required',
            'proposal_id' => 'required',
            'status' => 'required',
        ]);

        Pendaftaran::create($request->all());

        return redirect()->route('pendaftarans.index')
                         ->with('success', 'Pendaftaran berhasil ditambahkan.');
    }

    // Menampilkan data pendaftaran yang dipilih
    public function show(Pendaftaran $pendaftaran)
    {
        return view('show-pendaftaran', compact('pendaftaran'));
    }

    // Menampilkan form untuk mengedit data pendaftaran
    public function edit(Pendaftaran $pendaftaran)
    {
        return view('edit-pendaftaran', compact('pendaftaran'));
    }

    // Memperbarui data pendaftaran yang dipilih di database
    public function update(Request $request, Pendaftaran $pendaftaran)
    {
        $request->validate([
            'user_id' => 'required',
            'kelompok_id' => 'required',
            'proposal_id' => 'required',
            'status' => 'required',
        ]);

        $pendaftaran->update($request->all());

        return redirect()->route('pendaftarans.index')
                         ->with('success', 'Pendaftaran berhasil diperbarui.');
    }

    // Menghapus data pendaftaran yang dipilih dari database
    public function destroy(Pendaftaran $pendaftaran)
    {
        $pendaftaran->delete();

        return redirect()->route('pendaftarans.index')
                         ->with('success', 'Pendaftaran berhasil dihapus.');
    }
}
