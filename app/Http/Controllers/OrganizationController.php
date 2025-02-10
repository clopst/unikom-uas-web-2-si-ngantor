<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function index()
    {
        $employees = Employee::with('position')->get();

        $buildTree = function ($employees, $parentId = null) use (&$buildTree) {
            return $employees
                ->where('parent_id', $parentId)
                ->map(function ($employee) use ($employees, $buildTree) {
                    return [
                        'id' => $employee->id,
                        'first_name' => $employee->first_name,
                        'last_name' => $employee->last_name,
                        'position' => $employee->position->name,
                        'level' => $employee->position->level,
                        'subordinates' => $buildTree($employees, $employee->id)
                    ];
                })->values();
        };

        return response()->json($buildTree(collect($employees)));
    }
}
