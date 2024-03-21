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

    //view all in my project
    public function my_project()
    {
        $userId = auth::user()->user_id;
        $pendaftaran = Pendaftaran::with(['user', 'kelompok', 'proposal'])
            ->where('user_id', $userId)
            ->get();
        $jumlahAnggota = Peserta::where('user_id', $userId)->count();

        // Mendapatkan proposal terkait dengan pengguna yang masuk
        $proposal = Proposal::whereHas('user', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->first();

        // Periksa jika proposal ditemukan
        if ($proposal) {
            $adaKolomKosong = empty($proposal->ide_bisnis) ||
                empty($proposal->model_bisnis_canvas) ||
                empty($proposal->deskripsi_laba_rugi) ||
                empty($proposal->file_laba_rugi) ||
                empty($proposal->file_pemasaran) ||
                empty($proposal->deskripsi_pemasaran) ||
                empty($proposal->deskripsi_maintenance) ||
                empty($proposal->file_maintenance);
        } else {
            // Jika proposal tidak ditemukan, tandai sebagai memiliki kolom kosong
            $adaKolomKosong = true;
        }

        return view('/user/myproject/myproject', [
            'pendaftaran' => $pendaftaran,
            'anggota' => $jumlahAnggota,
            'adaKolomKosong' => $adaKolomKosong,
        ]);
    }


    //form input
    public function ide_bisnis(Request $request)
    {
        // Mendapatkan ID pengguna yang sedang login
        $userId = Auth::user()->user_id;
        // Mengambil data peserta yang memiliki user_id yang sesuai dengan ID pengguna yang sedang login
        $pesertaList = Peserta::where('user_id', $userId)->get();
        $proposal = Proposal::where('user_id', $userId)->get();
        $pendaftaran = Pendaftaran::where('user_id', $userId)->get();

        return view('user.myproject.form.form-ide-bisnis', ['pesertaList' => $pesertaList, 'proposal' => $proposal]);
    }
    public function laba_rugi(Request $request)
    {
        // Mendapatkan ID pengguna yang sedang login
        $userId = Auth::user()->user_id;
        // Mengambil data peserta yang memiliki user_id yang sesuai dengan ID pengguna yang sedang login
        $pesertaList = Peserta::where('user_id', $userId)->get();
        $proposal = Proposal::where('user_id', $userId)->get();

        return view('user.myproject.form.form-laba-rugi', ['pesertaList' => $pesertaList, 'proposal' => $proposal]);
    }
    public function pemasaran(Request $request)
    {
        // Mendapatkan ID pengguna yang sedang login
        $userId = Auth::user()->user_id;
        // Mengambil data peserta yang memiliki user_id yang sesuai dengan ID pengguna yang sedang login
        $pesertaList = Peserta::where('user_id', $userId)->get();
        $proposal = Proposal::where('user_id', $userId)->get();

        return view('user.myproject.form.form-pemasaran', ['pesertaList' => $pesertaList, 'proposal' => $proposal]);
    }
    public function maintenance(Request $request)
    {
        // Mendapatkan ID pengguna yang sedang login
        $userId = Auth::user()->user_id;
        // Mengambil data peserta yang memiliki user_id yang sesuai dengan ID pengguna yang sedang login
        $pesertaList = Peserta::where('user_id', $userId)->get();
        $proposal = Proposal::where('user_id', $userId)->get();

        return view('user.myproject.form.form-maintenance', ['pesertaList' => $pesertaList, 'proposal' => $proposal]);
    }

    //kelompok
    public function nama_kelompok(){
        return view('user.myproject.create-kelompok');
    }
    public function create_kelompok(Request $request)
    {
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
            'user_id' => $user->user_id,
            'nama_kelompok' => $request->nama_kelompok,
        ]);
        $proposal = Proposal::create([
            'user_id' => $user->user_id,
            'kelompok_id' => $kelompok->id,
            'judul_proposal' => $request->judul_proposal,
            'status' => 'Proses',
        ]);
        $pendaftaran = Pendaftaran::create([
            'user_id' => $user->user_id,
            'kelompok_id' => $kelompok->id,
            'proposal_id' => $proposal->id_proposal,
            'status' => 'Proses',
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
        return redirect('/dashboard/myproject')->with('error', 'Nama Kelompok sudah ada');
    }

    public function kelompok()
    {
        $userId = Auth::user()->user_id;
        $peserta = Peserta::where('user_id', $userId)->get();
        $proposal = Proposal::where('user_id', $userId)->get();

        return view('user.myproject.create-tim', ['pesertaList' => $peserta, 'proposal' => $proposal]);
    }


    //anggota
    public function create_anggota(Request $request)
    {

        $userId = Auth::user()->user_id;
        //menentukan proposal berdasarkan user_id
        $proposal = Proposal::where('user_id', $userId)->get();

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

        foreach ($proposal as $data) {
            // Memeriksa apakah jumlah anggota sudah mencapai batas maksimum (5)
            if ($jumlahAnggota <= 5) {
                Peserta::create($request->all());
                return redirect('/myproject/proposal/' . $data->id_proposal)->with('success', 'Data berhasil disimpan.');
            } else {
                return redirect('/myproject/proposal/' . $data->id_proposal)->with('error', 'Jumlah Anggota Sudah Melebihi Kapasitas');
            }
        }
    }

    //proposal Create
    public function ide_bisnis_create(Request $request)
    {
        $request->validate([
            'ide_bisnis' => 'string|nullable',
            'model_bisnis_canvas' => 'nullable|file|mimes:pdf|max:10240', // File model bisnis (optional)
        ]);
        $proposal = Proposal::findOrFail($request->id_proposal);
        // Upload dan simpan file model bisnis jika ada
        if ($request->hasFile('model_bisnis_canvas')) {
            $kelompok = $proposal->kelompok->nama_kelompok; // Ambil nama kelompok dari proposal
            $judulProposal = $proposal->judul_proposal; // Ambil judul proposal dari proposal
            $namaFile = $kelompok . '_' . $judulProposal . '_model_bisnis_canvas.pdf'; // Buat nama file dengan format nama_kelompok_judul_proposal_model_bisnis_canvas.pdf
            $modelBisnisCanvasPath = $request->file('model_bisnis_canvas')->storeAs('model_bisnis_canvas', $namaFile, 'public');
            $proposal->model_bisnis_canvas = $namaFile;
        }
        // Simpan data ke database
        $proposal->ide_bisnis = $request->ide_bisnis;

        $proposal->save();

        // Redirect atau lakukan apa pun yang diperlukan setelah update berhasil
        return redirect()->back()->with('success', 'Proposal berhasil diperbarui.');
    }

    public function laba_rugi_create(Request $request)
    {
        $request->validate([
            'deskripsi_laba_rugi' => 'string|nullable',
            'file_laba_rugi' => 'nullable|file|mimes:pdf|max:10240', // File laba rugi (optional)
        ]);
        $proposal = Proposal::findOrFail($request->id_proposal);
        // Upload dan simpan file laba rugi jika ada
        if ($request->hasFile('file_laba_rugi')) {
            $kelompok = $proposal->kelompok->nama_kelompok; // Ambil nama kelompok dari proposal
            $judulProposal = $proposal->judul_proposal; // Ambil judul proposal dari proposal
            $namaFile = $kelompok . '_' . $judulProposal . '_file_laba_rugi.pdf'; // Buat nama file dengan format nama_kelompok_judul_proposal_file_laba_rugi.pdf
            $fileLabaRugiPath = $request->file('file_laba_rugi')->storeAs('file_laba_rugi', $namaFile, 'public');
            $proposal->file_laba_rugi = $namaFile;
        }
        // Simpan data ke database
        $proposal->deskripsi_laba_rugi = $request->deskripsi_laba_rugi;
        $proposal->save();

        // Redirect atau lakukan apa pun yang diperlukan setelah update berhasil
        return redirect()->back()->with('success', 'Proposal berhasil diperbarui.');
    }

    public function pemasaran_create(Request $request)
    {
        $request->validate([
            'file_pemasaran' => 'nullable|file|mimes:pdf|max:10240', // File pemasaran (optional)
            'deskripsi_pemasaran' => 'string|nullable',
        ]);
        $proposal = Proposal::findOrFail($request->id_proposal);
        // Upload dan simpan file pemasaran jika ada
        if ($request->hasFile('file_pemasaran')) {
            $kelompok = $proposal->kelompok->nama_kelompok; // Ambil nama kelompok dari proposal
            $judulProposal = $proposal->judul_proposal; // Ambil judul proposal dari proposal
            $namaFile = $kelompok . '_' . $judulProposal . '_file_pemasaran.pdf'; // Buat nama file dengan format nama_kelompok_judul_proposal_file_pemasaran.pdf
            $filePemasaranPath = $request->file('file_pemasaran')->storeAs('file_pemasaran', $namaFile, 'public');
            $proposal->file_pemasaran = $namaFile;
        }
        // Simpan data ke database
        $proposal->deskripsi_pemasaran = $request->deskripsi_pemasaran;

        $proposal->save();

        // Redirect atau lakukan apa pun yang diperlukan setelah update berhasil
        return redirect()->back()->with('success', 'Proposal berhasil diperbarui.');
    }

    public function maintenance_create(Request $request)
    {
        $request->validate([
            'deskripsi_maintenance' => 'string|nullable',
            'file_maintenance' => 'nullable|file|mimes:pdf|max:10240', // File maintenance (optional)
        ]);
        $proposal = Proposal::findOrFail($request->id_proposal);
        // Upload dan simpan file maintenance jika ada
        if ($request->hasFile('file_maintenance')) {
            $kelompok = $proposal->kelompok->nama_kelompok; // Ambil nama kelompok dari proposal
            $judulProposal = $proposal->judul_proposal; // Ambil judul proposal dari proposal
            $namaFile = $kelompok . '_' . $judulProposal . '_file_maintenance.pdf'; // Buat nama file dengan format nama_kelompok_judul_proposal_file_maintenance.pdf
            $fileMaintenancePath = $request->file('file_maintenance')->storeAs('file_maintenance', $namaFile, 'public');
            $proposal->file_maintenance = $namaFile;
        }
        // Simpan data ke database
        $proposal->deskripsi_maintenance = $request->deskripsi_maintenance;

        $proposal->save();

        // Redirect atau lakukan apa pun yang diperlukan setelah update berhasil
        return redirect()->back()->with('success', 'Proposal berhasil diperbarui.');
    }

    public function publish()
    {
        $userId = Auth::user()->user_id;
        $pendaftaran = Pendaftaran::with(['user', 'kelompok', 'proposal'])
            ->where('user_id', $userId)
            ->get();
            foreach ($pendaftaran as $daftar){
                $daftar->proposal->status = 'Publish';
                $daftar->proposal->save();
                $daftar->status = 'Seleksi';
                $daftar->save();
            }
            return redirect('/myproject')->with('success', 'Data berhasil disimpan.');
    }
}
