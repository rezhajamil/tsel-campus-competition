<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Peserta;
use App\Models\Kelompok;
use App\Models\Proposal;
use App\Models\Timeline;
use App\Models\Pendaftaran;
use App\Notifications\PendaftaranNotification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Notifications\PublishNotification;
use Illuminate\Support\Facades\Notification;

class ProjectController extends Controller
{

    //form input
    public function ide_bisnis(Request $request)
    {
        // Mendapatkan ID pengguna yang sedang login
        $userId = Auth::user()->user_id;
        // Mengambil data peserta yang memiliki user_id yang sesuai dengan ID pengguna yang sedang login
        $pesertaList = Peserta::where('user_id', $userId)->get();
        $proposal = Proposal::where('user_id', $userId)->get();
        $pendaftarans = Pendaftaran::where('user_id', $userId)->get();

        return view('user.myproject.form.form-ide-bisnis', ['pesertaList' => $pesertaList, 'pendaftarans' => $pendaftarans]);
    }
    public function laba_rugi(Request $request)
    {
        // Mendapatkan ID pengguna yang sedang login
        $userId = Auth::user()->user_id;
        // Mengambil data peserta yang memiliki user_id yang sesuai dengan ID pengguna yang sedang login
        $pesertaList = Peserta::where('user_id', $userId)->get();
        $pendaftarans = Pendaftaran::where('user_id', $userId)->get();

        return view('user.myproject.form.form-laba-rugi', ['pesertaList' => $pesertaList, 'pendaftarans' => $pendaftarans]);
    }
    public function pemasaran(Request $request)
    {
        // Mendapatkan ID pengguna yang sedang login
        $userId = Auth::user()->user_id;
        // Mengambil data peserta yang memiliki user_id yang sesuai dengan ID pengguna yang sedang login
        $pesertaList = Peserta::where('user_id', $userId)->get();
        $pendaftarans = Pendaftaran::where('user_id', $userId)->get();

        return view('user.myproject.form.form-pemasaran', ['pesertaList' => $pesertaList, 'pendaftarans' => $pendaftarans]);
    }
    public function maintenance(Request $request)
    {
        // Mendapatkan ID pengguna yang sedang login
        $userId = Auth::user()->user_id;
        // Mengambil data peserta yang memiliki user_id yang sesuai dengan ID pengguna yang sedang login
        $pesertaList = Peserta::where('user_id', $userId)->get();
        $pendaftarans = Pendaftaran::where('user_id', $userId)->get();

        return view('user.myproject.form.form-maintenance', ['pesertaList' => $pesertaList, 'pendaftarans' => $pendaftarans]);
    }

    //kelompok
    public function nama_kelompok()
    {
        $timeline = Timeline::all();
        return view('user.myproject.create-kelompok', ['timelines' => $timeline]);
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
        $admin = User::where('role', 'Admin')->get();
        Notification::send($admin, new PendaftaranNotification($pendaftaran));
        notify()->success('Proposal Berhasil Di Buat', 'BAGUS');
        return redirect()->route('my_project')->with('error', 'Nama Kelompok sudah ada');
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
            if ($jumlahAnggota <= 4) {
                Peserta::create($request->all());
                return redirect()->route('model-bisnis', $data->id_proposal)->with('success', 'Data berhasil disimpan.');
            } else {
                return redirect()->route('model-bisnis', $data->id_proposal)->with('error', 'Jumlah Anggota Sudah Melebihi Kapasitas');
            }
        }
    }

    //proposal Create
    public function ide_bisnis_create(Request $request, $id_proposal)
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

        notify()->success('Data Ide Bisnis Berhasil Di Input', 'BAGUS');
        // Redirect atau lakukan apa pun yang diperlukan setelah update berhasil
        return redirect()->route('model-bisnis', $id_proposal)->with('success', 'Proposal berhasil diperbarui.');
    }

    public function laba_rugi_create(Request $request, $id_proposal)
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
        $proposal->deskripsi_laba_rugi = strip_tags($request->deskripsi_laba_rugi);
        $proposal->save();

        notify()->success('Data Laba-Rugi Berhasil Di Input', 'BAGUS');
        // Redirect atau lakukan apa pun yang diperlukan setelah update berhasil
        return redirect()->route('model-bisnis', $id_proposal)->with('success', 'Proposal berhasil diperbarui.');
    }

    public function pemasaran_create(Request $request, $id_proposal)
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
        $proposal->deskripsi_pemasaran = strip_tags($request->deskripsi_pemasaran);

        $proposal->save();

        notify()->success('Data Pemasaran Berhasil Di Input', 'BAGUS');
        // Redirect atau lakukan apa pun yang diperlukan setelah update berhasil
        return redirect()->route('model-bisnis', $id_proposal)->with('success', 'Proposal berhasil diperbarui.');
    }

    public function maintenance_create(Request $request, $id_proposal)
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
        $proposal->deskripsi_maintenance = strip_tags($request->deskripsi_maintenance);

        $proposal->save();

        notify()->success('Data Maintenance Berhasil Di Input', 'BAGUS');
        // Redirect atau lakukan apa pun yang diperlukan setelah update berhasil
        return redirect()->route('model-bisnis', $id_proposal)->with('success', 'Proposal berhasil diperbarui.');
    }

    public function publish()
    {
        $userId = Auth::user()->user_id;
        $pendaftaran = Pendaftaran::with(['user', 'kelompok', 'proposal'])
            ->where('user_id', $userId)
            ->get();
        foreach ($pendaftaran as $daftar) {
            $daftar->proposal->status = 'Publish';
            $daftar->proposal->save();
            $daftar->status = 'Seleksi';
            $daftar->save();
        }
        $admin = User::where('role', 'admin')->first();
        Notification::send($admin, new PublishNotification($pendaftaran));
        notify()->success('Proposal Berhasil Di Publish', 'BAGUS');
        return redirect()->route('my_project')->with('success', 'Data berhasil disimpan.');
    }
}
