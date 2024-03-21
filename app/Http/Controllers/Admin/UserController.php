<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kelompok;
use App\Models\Pendaftaran;
use App\Models\Proposal;
use App\Models\Peserta;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::query();

        // Search query
        if ($request->filled('search')) {
            $search = $request->input('search');
            $users->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
          ->orWhere('email', 'like', '%' . $search . '%')
          ->orWhere('telp', 'like', '%' . $search . '%')
          ->orWhere('npsn', 'like', '%' . $search . '%') // Menambahkan pencarian berdasarkan NPSN
          ->orWhere('nim', 'like', '%' . $search . '%'); // Menambahkan pencarian berdasarkan NIM
            });
        }

        $users = $users->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'telp' => 'required|string|regex:/^\d{3}-\d+$/',
            'role' => 'required|string|in:admin,user',
        ]);

        User::create($request->all());

        return redirect()->route('admin.users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_id)
    {
        $user = User::where('user_id', $user_id)->firstOrFail();
    
        
        $user->update($request->all());
    
        return redirect()->route('admin.users.index')
            ->with('success', 'User updated successfully.');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id)
    {
        // Hapus semua entri yang terkait dari tabel 'peserta'
        Peserta::where('user_id', $user_id)->delete();

        // Hapus semua proposal yang diajukan oleh pengguna
        Proposal::where('user_id', $user_id)->delete();

        // Hapus semua entri yang terkait dari tabel 'pendaftaran'
        Pendaftaran::whereHas('kelompok', function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        })->delete();

        // Hapus semua entri yang terkait dari tabel 'kelompok'
        Kelompok::where('user_id', $user_id)->delete();

        // Hapus pengguna berdasarkan ID
        $user = User::where('user_id', $user_id)->firstOrFail();
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully.');
    }
    
}
