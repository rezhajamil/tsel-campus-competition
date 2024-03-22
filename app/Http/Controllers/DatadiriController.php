<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DatadiriController extends Controller
{
    public function create(Request $request){

        $request->validate([
            'npsn' => 'required|exists:data_sekolah_sumatera,NPSN',
            'nim' => 'required|string|unique:users,nim',
        ], [
            'nim.unique' => 'NIM sudah Terdaftar',
            'npsn.required' => 'NPSN wajib diisi.',
            'npsn.exists' => 'NPSN tidak valid.',
        ]);
        $userId = Auth::user()->user_id;
        $peserta = User::findOrFail($userId);
        $peserta->update($request->all());
    
        // 5. Redirect pengguna ke halaman yang sesuai setelah berhasil melakukan update
        return redirect()->route('data-diri')->with('success', 'Data berhasil diperbarui.');

    }
    
}
