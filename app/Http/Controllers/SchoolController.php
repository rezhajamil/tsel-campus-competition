<?php

namespace App\Http\Controllers;

use App\Models\DataSekolah;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $schools = DataSekolah::where('NAMA_SEKOLAH', 'LIKE', "%{$query}%")
            ->where('KATEGORI_JENJANG', 'KAMPUS')
            ->where('REGIONAL', 'SUMBAGUT')
            ->paginate(5);
        return response()->json($schools);
    }
}
