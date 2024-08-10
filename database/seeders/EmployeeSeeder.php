<?php

// 10123914 - DIMAS NURFAUZI

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $direkturId = 1;
        $managerId = 2;
        $staffId = 3;

        Employee::create([
            'first_name' => 'Dimas',
            'last_name' => 'Nurfauzi',
            'gender' => 'male',
            'birth_date' => '2002-03-29',
            'position_id' => 1,
            'shift_id' => 1,
        ]);

        Employee::create([
            'first_name' => 'Andi',
            'last_name' => 'Tegar',
            'gender' => 'male',
            'birth_date' => '2001-01-14',
            'position_id' => 2,
            'shift_id' => 1,
        ]);

        Employee::create([
            'first_name' => 'Gilbert',
            'last_name' => 'Santoso',
            'gender' => 'male',
            'birth_date' => '2001-06-08',
            'position_id' => 3,
            'shift_id' => 1,
        ]);

        for ($i = 0; $i < 3; $i++) {
            Employee::factory()->create([
                'position_id' => $direkturId,
            ]);
        }

        for ($i = 0; $i < 5; $i++) {
            Employee::factory()->create([
                'position_id' => $managerId,
            ]);
        }

        for ($i = 0; $i < 10; $i++) {
            Employee::factory()->create([
                'position_id' => $staffId,
            ]);
        }
    }
}
