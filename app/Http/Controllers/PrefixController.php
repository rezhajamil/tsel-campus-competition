<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrefixController extends Controller
{
    public function getTelkomselPrefixes()
    {
        // Ambil kode prefix Telkomsel dari tabel kode_prefix_operator
        $telkomselPrefixes = DB::table('kode_prefix_operator')
            ->where('operator', 'Telkomsel')
            ->pluck('kode_prefix')
            ->toArray();

        return response()->json($telkomselPrefixes);
    }
}
