<?php

namespace App\Http\Controllers;

use App\Models\DataSekolah;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class KampusController extends Controller
{
    public function getKampusByKeyword(Request $request)
    {
        $keyword = $request->input('keyword');
        $limit = 10; // Tetapkan batas data yang diambil

        $kampusList = DataSekolah::where('NAMA_SEKOLAH', 'LIKE', "%$keyword%")
            ->orWhere('NPSN', 'LIKE', "%$keyword%")
            ->take($limit) // Tetapkan batas data yang diambil
            ->get();

        return response()->json(['kampusList' => $kampusList]);
    }
}
