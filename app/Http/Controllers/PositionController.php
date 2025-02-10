<?php

// 10123909 - Andi Tegar Permadi

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

        return view('positions.create', );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $position = new Position([
            'name' => $request->name,
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

        return view('positions.edit', ['position' => $position]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Position $position)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $position->fill([
            'name' => $request->name,
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
