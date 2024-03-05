<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Kategori;
use App\Models\Proposal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PesertaController extends Controller
{
    public function index(Request $request)
    {
        // Menentukan nilai $page berdasarkan nama route
        $id_proposal = $request->route('id_proposal');

        // Mendapatkan ID pengguna yang sedang login
        $userId = Auth::user()->user_id;

        // Mengambil data peserta yang memiliki user_id yang sesuai dengan ID pengguna yang sedang login
        $pesertaList = Peserta::where('user_id', $userId)->get();
        $proposal = Proposal::where('id_proposal', $id_proposal)->get();

        // Mengembalikan view dengan data peserta
        return view('user.myproject.model-bisnis', ['pesertaList' => $pesertaList, 'proposal' => $proposal,'id_proposal' => $id_proposal]);
    }
    public function store(Request $request)
    {
        $userId = Auth::user()->user_id;

        // Menghitung jumlah anggota yang sudah ada dengan user_id yang sama
        $jumlahAnggota = Peserta::where('user_id', $userId)->count();

        $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'nama_lengkap' => 'required|string',
            'npsn' => 'required|exists:data_sekolah_sumatera,NPSN',
            'nim' => 'required|string|unique:peserta,nim',
            'nama_kelompok' =>  'required|string',
            'nomor_wa' => 'required|string|max:15',
            'email' => 'required|email|unique:peserta,email',
            'kemampuan_deskripsi' => 'required|string|max:255',
            'jabatan' => 'required|string',

        ], [
            'user_id.required' => 'User ID wajib diisi.',
            'user_id.exists' => 'User ID tidak valid.',
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'nama_lengkap.max' => 'Nama lengkap tidak boleh lebih dari 255 karakter.',
            'nim.unique' => 'NIM sudah Terdaftar',
            'npsn.required' => 'NPSN wajib diisi.',
            'npsn.exists' => 'NPSN tidak valid.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'nomor_wa.required' => 'Nomor WA wajib diisi.',
            'nomor_wa.max' => 'Nomor WA tidak boleh lebih dari 15 karakter.',
            'kemampuan_deskripsi.required' => 'Deskripsi kemampuan wajib diisi.',
            'kemampuan_deskripsi.max' => 'Deskripsi kemampuan tidak boleh lebih dari 255 karakter.',
            'jabatan.required' => 'Jabatan wajib diisi.',
        ]);


        // Memeriksa apakah jumlah anggota sudah mencapai batas maksimum (5)
        if ($jumlahAnggota <= 5) {
            Peserta::create($request->all());
            return redirect('/dashboard/model-bisnis')->with('success', 'Data berhasil disimpan.');
        } else {
            return redirect('/dashboard/model-bisnis')->with('error', 'Jumlah Anggota Sudah Melebihi Kapasitas');
        }
    }
}
