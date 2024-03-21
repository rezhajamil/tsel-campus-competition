<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Proposal;
use App\Models\Kelompok;
use App\Models\Pendaftaran;
use App\Models\Peserta;

use Illuminate\Http\Request;

class ProposalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $kelompoks = Kelompok::all();

        $query = Proposal::query();


        if ($request->filled('kelompok')) {
            $query->whereHas('kelompok', function ($query) use ($request) {
                $query->where('nama_kelompok', $request->kelompok);
            });
        }


        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {

                $q->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%");
                });
                $q->orWhere('judul_proposal', 'like', "%$search%");
            });
        }

        $query->with(['kelompok', 'user']);

        $proposals = $query->paginate(10);
        return view('admin.proposals.index', compact('proposals', 'kelompoks'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.proposals.create');
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

        Proposal::create($request->all());

        return redirect()->route('admin.proposals.index')
            ->with('success', 'Proposal created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Proposal  $proposal
     * @return \Illuminate\Http\Response
     */
    public function show(Proposal $proposal)
    {
        return view('admin.proposals.show', compact('proposal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Proposal  $proposal
     * @return \Illuminate\Http\Response
     */
    public function edit(Proposal $proposal)
    {
        return view('admin.proposals.edit', compact('proposal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Proposal  $proposal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id_proposal)
    {
        $request->validate([
            // Add validation rules here based on your requirements
        ]);

        $proposal = Proposal::where('id_proposal', $id_proposal)->firstorFail();
        $proposal->update($request->all());

        return redirect()->route('admin.proposals.index')
            ->with('success', 'Proposal updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Proposal  $proposal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_proposal)
    {
        try {
            // Hapus Pendaftaran yang terkait dengan Proposal
            Pendaftaran::where('id_proposal', $id_proposal)->delete();

            // Hapus Proposal
            Proposal::findOrFail($id_proposal)->delete();

            return redirect()->route('admin.proposals.index')
                ->with('success', 'Proposal deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to delete proposal. Error: ' . $e->getMessage());
        }
    }


    /**
     * Update the status of the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id_proposal
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request, $id_proposal)
    {
        $request->validate([
            'status' => 'required|in:Approved,Rejected',
        ]);

        $proposal = Proposal::findOrFail($id_proposal);
        $proposal->status = $request->status;
        $proposal->save();

        return redirect()->route('admin.proposals.index')
            ->with('success', 'Proposal status updated successfully.');
    }
}
