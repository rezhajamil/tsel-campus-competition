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
    public function ktm($nama, $file)
    {
        $ktmFilename = $nama . '_KTM.' . $file->extension();
        $ktmPath = $file->storeAs('ktm', $ktmFilename, 'public');
        return $ktmPath;
    }

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
            'kelompok_id' => $kelompok->kelompok_id,
            'judul_proposal' => $request->judul_proposal,
            'status' => 'Proses',
        ]);
        $pendaftaran = Pendaftaran::create([
            'user_id' => $user->user_id,
            'kelompok_id' => $kelompok->kelompok_id,
            'proposal_id' => $proposal->proposal_id,
            'status' => 'Proses',
        ]);
        $ketua = Peserta::create([
            'user_id' => $user->user_id,
            'nama_lengkap' => $user->name,
            'npsn' => $user->npsn,
            'nim' => $user->nim,
            'nama_kelompok' => $kelompok->nama_kelompok,
            'nomor_wa' => $user->telp,
            'email' => $user->email,
            'jabatan' => 'Ketua'
        ]);
        $ketua->ktm = $user->ktm;
        $ketua->save();

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

        // Menentukan proposal berdasarkan user_id
        $proposal = Proposal::where('user_id', $userId)->get();

        // Menghitung jumlah anggota yang sudah ada dengan user_id yang sama
        $jumlahAnggota = Peserta::where('user_id', $userId)->count();

        $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'npsn' => 'required|string',
            'nama_lengkap' => 'required|string|max:255',
            'nim' => 'required|string|unique:peserta,nim',
            'nama_kelompok' => 'required|string',
            'nomor_wa' => 'required|string|max:15',
            'email' => 'required|email|unique:peserta,email',
            'ktm' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'], // Tambahkan batas ukuran jika perlu
            'jabatan' => 'required|string',
        ], [
            'user_id.required' => 'User ID wajib diisi.',
            'user_id.exists' => 'User ID tidak valid.',
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'nama_lengkap.max' => 'Nama lengkap tidak boleh lebih dari 255 karakter.',
            'nim.unique' => 'NIM sudah terdaftar.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'nomor_wa.required' => 'Nomor WA wajib diisi.',
            'nomor_wa.max' => 'Nomor WA tidak boleh lebih dari 15 karakter.',
            'ktm.required' => 'KTM wajib diisi.',
            'ktm.mimes' => 'Format file tidak valid.',
            'ktm.max' => 'Ukuran file maksimum 2MB.',
            'jabatan.required' => 'Jabatan wajib diisi.',
        ]);

        foreach ($proposal as $data) {
            // Memeriksa apakah jumlah anggota sudah mencapai batas maksimum (5)
            if ($jumlahAnggota < 5) {
                // Menyimpan file ktm dengan nama baru
                $ktmPath = $this->ktm($request->nama_lengkap, $request->file('ktm'));



                // Membuat peserta baru
                // Membuat instance baru dari Peserta
                $peserta = new Peserta;
                $peserta->user_id = $request->user_id;
                $peserta->npsn = $request->npsn; // Menyimpan npsn
                $peserta->nama_lengkap = $request->nama_lengkap;
                $peserta->nim = $request->nim;
                $peserta->nomor_wa = $request->nomor_wa;
                $peserta->email = $request->email;
                $peserta->ktm = $ktmPath; // Simpan path file ktm
                $peserta->jabatan = $request->jabatan;
                $peserta->nama_kelompok = $request->nama_kelompok;

                // Menyimpan data peserta ke database
                $peserta->save();

                return redirect()->route('model-bisnis', $data->proposal_id)->with('success', 'Data berhasil disimpan.');
            } else {
                return redirect()->route('model-bisnis', $data->proposal_id)->with('error', 'Jumlah anggota sudah melebihi kapasitas.');
            }
        }
    }


    //proposal Create
    public function ide_bisnis_create(Request $request, $proposal_id)
    {
        $request->validate([
            'ide_bisnis' => 'string|nullable',
            'model_bisnis_canvas' => 'nullable|file|mimes:pdf|max:10240', // File model bisnis (optional)
        ]);
        $proposal = Proposal::findOrFail($request->proposal_id);
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
        return redirect()->route('model-bisnis', $proposal_id)->with('success', 'Proposal berhasil diperbarui.');
    }

    public function laba_rugi_create(Request $request, $proposal_id)
    {
        $request->validate([
            'deskripsi_laba_rugi' => 'string|nullable',
            'file_laba_rugi' => 'nullable|file|mimes:pdf|max:10240', // File laba rugi (optional)
        ]);
        $proposal = Proposal::findOrFail($request->proposal_id);
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
        return redirect()->route('model-bisnis', $proposal_id)->with('success', 'Proposal berhasil diperbarui.');
    }

    public function pemasaran_create(Request $request, $proposal_id)
    {
        $request->validate([
            'file_pemasaran' => 'nullable|file|mimes:pdf|max:10240', // File pemasaran (optional)
            'deskripsi_pemasaran' => 'string|nullable',
        ]);
        $proposal = Proposal::findOrFail($request->proposal_id);
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
        return redirect()->route('model-bisnis', $proposal_id)->with('success', 'Proposal berhasil diperbarui.');
    }

    public function maintenance_create(Request $request, $proposal_id)
    {
        $request->validate([
            'deskripsi_maintenance' => 'string|nullable',
            'file_maintenance' => 'nullable|file|mimes:pdf|max:10240', // File maintenance (optional)
        ]);
        $proposal = Proposal::findOrFail($request->proposal_id);
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
        return redirect()->route('model-bisnis', $proposal_id)->with('success', 'Proposal berhasil diperbarui.');
    }

    public function publish()
    {
        $userId = Auth::user()->user_id;

        // Mengambil data pendaftaran yang terkait dengan user_id
        $pendaftaran = Pendaftaran::with(['user', 'kelompok', 'proposal'])
            ->where('user_id', $userId)
            ->first();

        // Mengambil data proposal yang terkait dengan user_id
        $proposal = Proposal::where('user_id', $userId)->first();

        // Periksa apakah pendaftaran dan proposal ditemukan
        if (!$pendaftaran || !$proposal) {
            notify()->error('Pendaftaran atau Proposal tidak ditemukan.', 'Gagal');
            return redirect()->route('my_project')->with('error', 'Data tidak ditemukan.');
        }

        // Mengubah status proposal menjadi 'Publish'
        $proposal->status = 'Publish';
        $proposal->save();

        // Mengubah status pendaftaran menjadi 'Seleksi'
        $pendaftaran->status = 'Seleksi';
        $pendaftaran->save();

        // Mengambil admin untuk pengiriman notifikasi
        $admin = User::where('role', 'admin')->first();
        if ($admin) {
            Notification::send($admin, new PublishNotification($pendaftaran));
        }

        // Notifikasi sukses
        notify()->success('Proposal Berhasil Di Publish', 'BAGUS');
        return redirect()->route('my_project')->with('success', 'Data berhasil disimpan.');
    }
}
