<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Kelompok;
use App\Models\Proposal;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{

    //view all
    public function my_project() {
        $userId = auth::user()->user_id;
        $pendaftaran = Pendaftaran::with(['user', 'kelompok', 'proposal'])
        ->where('user_id',$userId)
        ->get();
        $jumlahAnggota = Peserta::where('user_id', $userId)->count();
        return view('/user/myproject/myproject', ['pendaftaran' => $pendaftaran, 'anggota'=>$jumlahAnggota]);
    }

    public function index(Request $request)
    {
        $routeName = $request->route()->getName();


        // Menentukan nilai $page berdasarkan nama route
        $page = '';
        if ($routeName === 'ide-bisnis') {
            $page = 'myproject.form.form-ide-bisnis';
        }elseif ($routeName === 'laba-rugi') {
            $page = 'myproject.form.form-laba-rugi';
        }elseif ($routeName === 'pemasaran') {
            $page = 'myproject.form.form-pemasaran';
        }elseif ($routeName === 'maintenance') {
            $page = 'myproject.form.form-ide-bisnis';
        }elseif ($routeName === 'model-bisnis') {
            $page = 'myproject.model-bisnis';
        } // Anda bisa tambahkan kondisi lain sesuai kebutuhan

        // Mendapatkan ID pengguna yang sedang login
        $userId = Auth::user()->user_id;

        // Mengambil data peserta yang memiliki user_id yang sesuai dengan ID pengguna yang sedang login
        $pesertaList = Peserta::where('user_id', $userId)->get();
        $proposal = Proposal::where('user_id', $userId)->get();

        // Mengembalikan view dengan data peserta
        return view('user.' . $page, ['pesertaList' => $pesertaList, 'proposal' => $proposal]);
    }

    //kelompok
    public function create_kelompok(Request $request){
        $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'nama_kelompok' =>  'required|string|unique:kelompok,nama_kelompok',
            'judul_proposal' =>  'required|string',
        ], [
            'user_id.required' => 'User ID wajib diisi.',
            'user_id.exists' => 'User ID tidak valid.',
            'nama_kelompok.unique' => "Nama Kelompok Sudah Di pakai"
        ]);
    
        $user = Auth::user();
            $kelompok = Kelompok::create([
                'user_id'=>$user->user_id,
                'nama_kelompok' => $request->nama_kelompok,
            ]);
            $proposal = Proposal::create([
                'user_id'=>$user->user_id,
                'kelompok_id'=>$kelompok->id,
                'judul_proposal' => $request->judul_proposal,
                'status'=>'Proses',
            ]);
            $pendaftaran = Pendaftaran::create([
                'user_id'=>$user->user_id,
                'kelompok_id'=>$kelompok->id,
                'proposal_id'=>$proposal->id_proposal,
            ]);
            Peserta::create([
                'user_id' => $user->user_id,
                'nama_lengkap' => $user->name,
                'npsn' => $user->npsn,
                'nim' => $user->nim,
                'nama_kelompok' => $kelompok->nama_kelompok,
                'nomor_wa' => $user->telp,
                'email' => $user->email,
                'kemampuan_deskripsi' => '',
                'jabatan' => 'Ketua',

                // Tambahkan kolom lain yang sesuai dengan kebutuhan Anda
            ]);
            return redirect('/dashboard/model-bisnis')->with('error', 'Nama Kelompok sudah ada');
    }


    //anggota
    public function create_anggota(Request $request){

        $userId = Auth::user()->user_id;
        //menentukan kelompok berdasarkan user_id

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

    //proposal
    public function create_proposal(Request $request){

    }
}
