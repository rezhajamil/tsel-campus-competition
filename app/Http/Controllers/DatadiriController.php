<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DatadiriController extends Controller
{
    public function create(Request $request){
        $ktmFilename = $request->name . '_KTM.' . $request->file('ktm')->extension();
        $ktmPath = $request->file('ktm')->storeAs('ktm', $ktmFilename, 'public');
        
        $userId = Auth::user()->user_id;
        $peserta = User::findOrFail($userId);
        $peserta->ktm = $ktmPath;
        $peserta->update([
            $request->all(),
        ]);
        notify()->success('Data Diri Berhasil Di Update', 'BAGUS');
        // 5. Redirect pengguna ke halaman yang sesuai setelah berhasil melakukan update
        return redirect()->route('data-diri')->with('success', 'Data berhasil diperbarui.');

    }
    
}
