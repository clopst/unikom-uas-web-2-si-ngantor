<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrganizationController extends Controller
{
    public function index()
    {
        $employees = DB::select("
            WITH RECURSIVE organization AS (
                SELECT
                    e.id,
                    e.first_name,
                    e.last_name,
                    e.parent_id,
                    p.name AS position,
                    p.level AS position_level
                FROM employees e
                JOIN positions p ON e.position_id = p.id
                WHERE e.parent_id IS NULL

                UNION ALL

                SELECT
                    e.id,
                    e.first_name,
                    e.last_name,
                    e.parent_id,
                    p.name AS position,
                    p.level AS position_level
                FROM employees e
                JOIN positions p ON e.position_id = p.id
                JOIN organization o ON e.parent_id = o.id
            )

            SELECT * FROM organization ORDER BY position_level, parent_id, id;
        ");

        $buildTree = function ($employees, $parentId = null) use (&$buildTree) {
            $tree = [];
            foreach ($employees as $employee) {
                if ($employee->parent_id == $parentId) {
                    $subordinates = $buildTree($employees, $employee->id);

                    $node = [
                        'id' => $employee->id,
                        'first_name' => $employee->first_name,
                        'last_name' => $employee->last_name,
                        'position' => $employee->position,
                        'level' => $employee->position_level,
                        'subordinates' => $subordinates
                    ];

                    $tree[] = $node;
                }
            }
            return $tree;
        };

        $employeesTree = $buildTree($employees);

        return response()->json($employeesTree);
    }
}
