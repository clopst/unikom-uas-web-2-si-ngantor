<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Shift;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = Position::with('parent');

            return DataTables::eloquent($model)->toJson();
        }

        return view('positions.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parents = Position::all();

        return view('positions.create', ['parents' => $parents]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'parent_id' => 'nullable|string|exists:positions,id',
        ]);

        $position = new Position([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
        ]);
        $position->save();

        return redirect()->route('positions.index')
            ->with('success', 'Position created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Position $position)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Position $position)
    {
        $position->load('parent');
        $parents = Position::whereNot('id', $position->id)->get();

        return view('positions.edit', ['position' => $position, 'parents' => $parents]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Position $position)
    {
        $request->validate([
            'name' => 'required|string',
            'parent_id' => 'nullable|string|exists:positions,id',
        ]);

        $position->fill([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
        ]);
        $position->save();

        return redirect()->route('positions.index')
            ->with('success', 'Position updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Position $position)
    {
        $position->delete();

        return redirect()->route('positions.index')
            ->with('success', 'Position deleted successfully.');
    }
}
