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
        return redirect('/dashboard/data-diri')->with('success', 'Data berhasil diperbarui.');

    }
    
    public function index(Request $request){
        $routeName = $request->route()->getName();

        // Menentukan nilai $page berdasarkan nama route
        $page = '';
        if ($routeName === 'data-diri') {
            $page = 'datadiri.data-diri';
        } elseif ($routeName === 'data-diri-edit') {
            $page = 'datadiri.data-diri-edit';
        } elseif ($routeName === 'myproject') {
            $page = 'myproject.myproject';
        }elseif ($routeName === 'create.index') {
            $page = 'myproject.create-kelompok';
        }// Anda bisa tambahkan kondisi lain sesuai kebutuhan
    
        // Mendapatkan ID pengguna yang sedang login
        $userId = Auth::user()->user_id;
    
        // Mengambil data peserta yang memiliki user_id yang sesuai dengan ID pengguna yang sedang login
        $datadiri = User::where('user_id', $userId)->get();
        
        // Mengembalikan view dengan data user
        return view('user.'.$page, ['datadiri' => $datadiri]);

    }
}
