<?php

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
