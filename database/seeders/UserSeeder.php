<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        $admin = new User([
            'email' => 'admin@company.com',
            'password' => bcrypt('password123'),
        ]);
        $admin->save();

        $employees = Employee::all();
        foreach ($employees as $employee) {
            $user = new User([
                'email' => Str::lower($employee->first_name) . '.' . Str::lower($employee->last_name) . '@company.com',
                'password' => bcrypt('password123'),
            ]);
            $user->employee()->associate($employee);
            $user->save();
        }
    }
}
