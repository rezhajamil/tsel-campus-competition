<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DatadiriController extends Controller
{
    public function create(Request $request)
    {
        // Validasi input
        $request->validate([
            'npsn' => 'nullable|string|max:255',
            'nim' => 'nullable|string|max:255',
            'name' => 'nullable|string|max:255',
            'telp' => 'nullable|string|max:15',
            'email' => 'nullable|string|email|max:255',
            'ktm' => 'nullable|image|mimes:jpeg,jpg,png|max:2048', // Tambahkan validasi untuk ktm
        ]);

        $userId = Auth::user()->user_id;
        $peserta = User::findOrFail($userId);

        // Jika file ktm diunggah, simpan file dan update path di database
        if ($request->hasFile('ktm')) {
            $ktmFilename = $request->name . '_KTM.' . $request->file('ktm')->extension();
            $ktmPath = $request->file('ktm')->storeAs('ktm', $ktmFilename, 'public');
            $peserta->ktm = $ktmPath;
        }

        // Update data user, kecuali ktm
        $peserta->update([
            'npsn' => $request->npsn,
            'nim' => $request->nim,
            'name' => $request->name,
            'telp' => $request->telp,
            'email' => $request->email,
        ]);

        // Notifikasi sukses
        notify()->success('Data Diri Berhasil Di Update', 'BAGUS');

        // Redirect pengguna ke halaman yang sesuai setelah berhasil melakukan update
        return redirect()->route('data-diri')->with('success', 'Data berhasil diperbarui.');
    }
}
