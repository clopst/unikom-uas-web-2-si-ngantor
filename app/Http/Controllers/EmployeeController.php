<?php

// 10123914 - DIMAS NURFAUZI

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Position;
use App\Models\Shift;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = Employee::with(['user', 'position', 'shift']);

            return DataTables::eloquent($model)->toJson();
        }

        return view('employees.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $positions = Position::all();
        $shifts = Shift::all();

        return view('employees.create', ['positions' => $positions, 'shifts' => $shifts]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'gender' => 'required|string|in:male,female',
            'birth_date' => 'required|date',
            'position_id' => 'required|string|exists:positions,id',
            'shift_id' => 'required|string|exists:shifts,id',
            'email' => 'required|string|email',
            'password' => 'required|string|min:6',
        ]);

        $employee = new Employee([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'birth_date' => $request->birth_date,
            'position_id' => $request->position_id,
            'shift_id' => $request->shift_id,
        ]);
        $employee->save();

        $user = new User([
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        $user->employee()->associate($employee);
        $user->save();

        return redirect()->route('employees.index')
            ->with('success', 'Employee created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $employee->load(['user']);

        $positions = Position::all();
        $shifts = Shift::all();

        return view('employees.edit', ['employee' => $employee, 'positions' => $positions, 'shifts' => $shifts]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'gender' => 'required|string|in:male,female',
            'birth_date' => 'required|date',
            'position_id' => 'required|string|exists:positions,id',
            'shift_id' => 'required|string|exists:shifts,id',
            'email' => 'required|string|email',
            'password' => 'nullable|string|min:6',
        ]);

        $employee->fill([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'birth_date' => $request->birth_date,
            'position_id' => $request->position_id,
            'shift_id' => $request->shift_id,
        ]);
        $employee->save();

        $employee->load('user');
        $user = $employee->user->fill([
            'email' => $request->email,
        ]);
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        return redirect()->route('employees.index')
            ->with('success', 'Employee updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employees.index')
            ->with('success', 'Employee deleted successfully.');
    }
}
