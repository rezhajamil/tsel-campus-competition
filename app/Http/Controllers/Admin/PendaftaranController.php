<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Retrieve all pendaftaran
        $pendaftarans = Pendaftaran::paginate(10);
        
        return view('admin.pendaftarans.index', compact('pendaftarans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pendaftarans.create');
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
            // Add validation rules here based on your requirements
        ]);

        Pendaftaran::create($request->all());

        return redirect()->route('admin.pendaftarans.index')
            ->with('success', 'Pendaftaran created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pendaftaran  $pendaftaran
     * @return \Illuminate\Http\Response
     */
    public function show(Pendaftaran $pendaftaran)
    {
        return view('admin.pendaftarans.show', compact('pendaftaran'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pendaftaran  $pendaftaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Pendaftaran $pendaftaran)
    {
        return view('admin.pendaftarans.edit', compact('pendaftaran'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pendaftaran  $pendaftaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id_pendaftaran)
    {
        $request->validate([
            // Add validation rules here based on your requirements
        ]);

        $pendaftaran = Pendaftaran::where('id', $id_pendaftaran)->firstOrFail();
        $pendaftaran->update($request->all());

        return redirect()->route('admin.pendaftarans.index')
            ->with('success', 'Pendaftaran updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pendaftaran  $pendaftaran
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_pendaftaran)
    {
        try {
            // Delete Pendaftaran
            Pendaftaran::findOrFail($id_pendaftaran)->delete();

            return redirect()->route('admin.pendaftarans.index')
                ->with('success', 'Pendaftaran deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to delete pendaftaran. Error: ' . $e->getMessage());
        }
    }

    /**
     * Update the status of the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id_pendaftaran
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request, $id_pendaftaran)
    {
        $request->validate([
            'status' => 'required|in:Approved,Rejected',
        ]);

        $pendaftaran = Pendaftaran::findOrFail($id_pendaftaran);
        $pendaftaran->status = $request->status;
        $pendaftaran->save();

        return redirect()->route('admin.pendaftarans.index')
            ->with('success', 'Pendaftaran status updated successfully.');
    }
}
