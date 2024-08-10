<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = Employee::with('shift')->get();

        $now = Carbon::now();
        $attendances = [];

        $date = $now->copy()->setDay(1);
        while ($date->diffInDays($now) > 0) {
            foreach ($employees as $employee) {
                $in = $date->copy()->setTimeFromTimeString($employee->shift->in);
                $minute = random_int(0, 20);
                $in->addMinutes($minute);
                $attendances[] = [
                    'employee_id' => $employee->id,
                    'type' => 'in',
                    'date' => $in,
                    'is_late' => $minute > $employee->shift->tolerance,
                    'created_at' => $in,
                    'updated_at' => $in,
                ];

                $out = $date->copy()->setTimeFromTimeString($employee->shift->out);
                $attendances[] = [
                    'employee_id' => $employee->id,
                    'type' => 'out',
                    'date' => $out,
                    'is_late' => false,
                    'created_at' => $out,
                    'updated_at' => $out,
                ];
            }
            $date->addDays(1);
        }

        Attendance::insert($attendances);
    }
}
