<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|in:in,out',
        ]);

        $user = $request->user()->load('employee.shift');

        $now = Carbon::now();
        $isLate = false;
        if ($request->type === 'in') {
            $shift = $user->employee->shift;

            $time = Carbon::createFromFormat('H:i:s', $shift->in);
            $diffMinutes = $time->diffInMinutes($now);
            $isLate = $diffMinutes > $shift->tolerance;
        }
        // dd($isLate);

        $attendance = new Attendance([
            'employee_id' => $user->employee->id,
            'type' => $request->type,
            'date' => $now,
            'is_late' => $isLate,
        ]);
        $attendance->save();

        return redirect()->route('index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        //
    }
}
