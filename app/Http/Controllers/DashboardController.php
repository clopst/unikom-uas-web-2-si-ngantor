<?php

// 10123914 - DIMAS NURFAUZI

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user()->load('employee.shift');

        $attendances = Attendance::where("employee_id", $user->employee->id)
            ->selectRaw('type, date(`date`) as date_day, cast(`date` as time) as time, is_late')
            ->groupByRaw('type, date_day, time, is_late')
            ->orderByRaw('date_day desc')
            ->orderByRaw('time desc')
            ->get();

        $now = Carbon::now();
        $attendanceToday = Attendance::where("employee_id", $user->employee->id)
            ->whereRaw('date(`date`) = ?', [$now->format('Y-m-d')])
            ->get();

        $attendanceStatus = [
            'should_attendance' => true,
            'type' => 'in',
        ];

        if ($attendanceToday->count() > 0) {
            $statusIn = $attendanceToday->where('type', 'in')->first();
            $statusOut = $attendanceToday->where('type', 'out')->first();

            if ($statusIn && $statusOut) {
                $attendanceStatus['should_attendance'] = false;
                $attendanceStatus['type'] = null;
            } else if ($statusIn) {
                $attendanceStatus['should_attendance'] = true;
                $attendanceStatus['type'] = 'out';
            }
        }

        return view('index', ['user' => $user, 'attendances' => $attendances, 'attendance_status' => $attendanceStatus]);
    }
}
