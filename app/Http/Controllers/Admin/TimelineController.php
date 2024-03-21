<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Timeline;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Retrieve all timelines
        $query = Timeline::query();
    
        // Jika terdapat parameter 'search' dalam request
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            // Melakukan pencarian berdasarkan nama atau deskripsi
            $query->where('nama', 'LIKE', "%$searchTerm%")
                  ->orWhere('deskripsi', 'LIKE', "%$searchTerm%");
        }
    
        // Paginasi hasil pencarian
        $timelines = $query->paginate(10);
        
        return view('admin.timelines.index', compact('timelines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.timelines.create');
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

        Timeline::create($request->all());

        return redirect()->route('admin.timelines.index')
            ->with('success', 'Timeline created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Timeline  $timeline
     * @return \Illuminate\Http\Response
     */
    public function show(Timeline $timeline)
    {
        return view('admin.timelines.show', compact('timeline'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Timeline  $timeline
     * @return \Illuminate\Http\Response
     */
    public function edit(Timeline $timeline)
    {
        return view('admin.timelines.edit', compact('timeline'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Timeline  $timeline
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_timeline)
    {
        $request->validate([
            // Add validation rules here based on your requirements
        ]);

        $timeline = Timeline::where('id', $id_timeline)->firstOrFail();
        $timeline->update($request->all());

        return redirect()->route('admin.timelines.index')
            ->with('success', 'Timeline updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Timeline  $timeline
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_timeline)
    {
        try {
            // Delete Timeline
            Timeline::findOrFail($id_timeline)->delete();

            return redirect()->route('admin.timelines.index')
                ->with('success', 'Timeline deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to delete timeline. Error: ' . $e->getMessage());
        }
    }

    /**
     * Update the status of the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id_timeline
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request, $id_timeline)
    {
        $request->validate([
            'status' => 'required|in:Approved,Rejected',
        ]);

        $timeline = Timeline::findOrFail($id_timeline);
        $timeline->status = $request->status;
        $timeline->save();

        return redirect()->route('admin.timelines.index')
            ->with('success', 'Timeline status updated successfully.');
    }
}
