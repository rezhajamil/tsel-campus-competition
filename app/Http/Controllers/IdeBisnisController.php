<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Proposal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IdeBisnisController extends Controller
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
        return view('user.myproject.form.form-ide-bisnis', ['pesertaList' => $pesertaList, 'proposal' => $proposal]);
    }
}
