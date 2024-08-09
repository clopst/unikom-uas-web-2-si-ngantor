<?php

// 10123910 - Gilbert Santoso

namespace App\Http\Controllers;

use App\Models\Shift;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = Shift::query();

            return DataTables::eloquent($model)->toJson();
        }

        return view('shifts.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('shifts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'in' => 'required|string',
            'out' => 'required|string',
            'tolerance' => 'required|integer',
        ]);

        $shift = new Shift([
            'name' => $request->name,
            'in' => $request->in,
            'out' => $request->out,
            'tolerance' => $request->tolerance,
        ]);
        $shift->save();

        return redirect()->route('shifts.index')
            ->with('success', 'Shift created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Shift $shift)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shift $shift)
    {
        return view('shifts.edit', ['shift' => $shift]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shift $shift)
    {
        $request->validate([
            'name' => 'required|string',
            'in' => 'required|string',
            'out' => 'required|string',
            'tolerance' => 'required|integer',
        ]);

        $shift->fill([
            'name' => $request->name,
            'in' => $request->in,
            'out' => $request->out,
            'tolerance' => $request->tolerance,
        ]);
        $shift->save();

        return redirect()->route('shifts.index')
            ->with('success', 'Shift updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shift $shift)
    {
        $shift->delete();

        return redirect()->route('shifts.index')
            ->with('success', 'Shift deleted successfully.');
    }
}
