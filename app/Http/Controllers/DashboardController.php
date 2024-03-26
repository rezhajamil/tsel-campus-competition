<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Peserta;
use App\Models\Proposal;
use App\Models\Timeline;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
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
        $accepted = $pendaftaran->where('status', 'Diterima')->count();
        $decline = $pendaftaran->where('status', 'Ditolak')->count();
        $seleksi = $pendaftaran->where('status', 'Seleksi')->count();
        $timeline = Timeline::all();

        return view('dashboard-user', [
            'pendaftaran' => $pendaftaran,
            'accepted' => $accepted,
            'decline' => $decline,
            'seleksi' => $seleksi,
            'anggota' => $jumlahAnggota,
            'timelines' => $timeline,
        ]);
    }

    public function datadiri(Request $request)
    {
        $routeName = $request->route()->getName();

        // Menentukan nilai $page berdasarkan nama route
        $page = '';
        if ($routeName === 'data-diri') {
            $page = 'datadiri.data-diri';
        } elseif ($routeName === 'data-diri-edit') {
            $page = 'datadiri.data-diri-edit';
        }

        // Mendapatkan ID pengguna yang sedang login
        $userId = Auth::user()->user_id;

        // Mengambil data peserta yang memiliki user_id yang sesuai dengan ID pengguna yang sedang login
        $datadiri = User::where('user_id', $userId)->get();
        $timeline = Timeline::all();

        // Mengembalikan view dengan data user
        return view('user.' . $page, ['datadiri' => $datadiri,'timelines'=>$timeline]);
    }

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
        $timeline = Timeline::all();

        return view('/user/myproject/myproject', [
            'pendaftaran' => $pendaftaran,
            'anggota' => $jumlahAnggota,
            'adaKolomKosong' => $adaKolomKosong,
            'timelines'=>$timeline,
        ]);
    }

    public function kelompok()
    {
        return view('user.myproject.create-kelompok');
    }
}
