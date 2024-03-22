<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peserta;
use App\Models\Kelompok;
class PesertaControllerAdmin extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Mengambil semua kelompok
        $kelompoks = Kelompok::all();

        $query = Peserta::query();

        // Filter berdasarkan kelompok jika ada
        if ($request->filled('kelompok')) {
            $query->where('nama_kelompok', $request->kelompok);
        }

        // Pencarian
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%$search%")
                    ->orWhere('npsn', 'like', "%$search%")
                    ->orWhere('nim', 'like', "%$search%");
            });
        }

        $pesertas = $query->paginate(10);
        return view('admin.Pesertas.index', compact('pesertas', 'kelompoks'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pesertas.create');
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
            'user_id' => 'required|integer',
            'nama_lengkap' => 'required|string',
            'npsn' => 'required|string',
            'nim' => 'required|string',
            'nama_kelompok' => 'required|string',
            'nomor_wa' => 'required|string',
            'email' => 'required|email',
            'kemampuan_deskripsi' => 'required|string',
            'jabatan' => 'required|string',
        ]);

        Peserta::create($request->all());

        return redirect()->route('admin.Pesertas.index')
            ->with('success', 'Peserta created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Peserta  $peserta
     * @return \Illuminate\Http\Response
     */
    public function show(Peserta $peserta)
    {
        return view('admin.Pesertas.show', compact('peserta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Peserta  $peserta
     * @return \Illuminate\Http\Response
     */
    public function edit(Peserta $peserta)
    {
        return view('admin.Pesertas.edit', compact('peserta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Peserta  $peserta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $peserta)
    {


        $pesertaid = Peserta::where('id', $peserta)->firstOrFail();

        $pesertaid->update($request->all());

        return redirect()->route('admin.Pesertas.index')
            ->with('success', 'Peserta updated successfully.');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Peserta  $peserta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Peserta $peserta)
    {
        Peserta::where('id', $peserta)->delete();

        return redirect()->route('admin.Pesertas.index')
            ->with('success', 'Peserta deleted successfully.');
    }
}
