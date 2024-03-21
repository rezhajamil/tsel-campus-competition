<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Proposal;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
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



        return view('dashboard-user', [
            'pendaftaran' => $pendaftaran,
            'accepted' => $accepted,
            'decline' => $decline,
            'seleksi' => $seleksi,
            'anggota' => $jumlahAnggota,
        ]);
    }

    public function kelompok(){
        return view('user.myproject.create-kelompok');
    }

}
