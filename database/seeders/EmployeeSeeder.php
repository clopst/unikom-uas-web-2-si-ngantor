<?php

// 10123914 - DIMAS NURFAUZI

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('id_ID');

        // Level 1
        // $this->createEmployee($faker, 1, 0); // CEO
        $employee = new Employee([
            'first_name' => 'Dimas',
            'last_name' => 'Nurfauzi',
            'gender' => 'male',
            'birth_date' => '2002-03-29',
            'position_id' => 1,
            'shift_id' => 1,
            'parent_id' => null,
        ]);
        $employee->save();

        /// Level 2
        $this->createEmployee($faker, 2, 1);
        $this->createEmployee($faker, 3, 1);
        $this->createEmployee($faker, 4, 1);

        // Level 3
        $this->createEmployee($faker, 5, 2);
        $this->createEmployee($faker, 6, 3);
        $this->createEmployee($faker, 7, 4);

        // Level 4
        $this->createEmployee($faker, 8, 5);
        $this->createEmployee($faker, 9, 6);
        $this->createEmployee($faker, 10, 7);

        // Level 5
        $this->createEmployee($faker, 11, 9);

        $employee = new Employee([
            'first_name' => 'Andi',
            'last_name' => 'Tegar',
            'gender' => 'male',
            'birth_date' => '2001-11-04',
            'position_id' => 11,
            'shift_id' => 2,
            'parent_id' => 9,
        ]);
        $employee->save();

        // Additional
        $this->createEmployee($faker, 8, 5);
        $this->createEmployee($faker, 10, 7);
        $this->createEmployee($faker, 10, 7);
        $this->createEmployee($faker, 10, 7);
    }

    public function createEmployee($faker, $positionId, $parentId, $shiftId = 1)
    {
        $gender = $faker->randomElement(['male', 'female']);
        $firstName = $gender == 'male' ? $faker->unique(false, 100000)->firstNameMale : $faker->unique(false, 100000)->firstNameFemale;
        $lastName = $faker->lastName;

        $employee = new Employee([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'gender' => $gender,
            'birth_date' => $faker->date('Y-m-d', '1990-12-31'),
            'position_id' => $positionId,
            'shift_id' => 1,
            'parent_id' => $parentId,
        ]);
        $employee->save();

        return $employee;
    }

    public function createEmployeeByPositionLevel($faker, $level, $parentId = null)
    {

        $positions = Position::where('level', $level)->get();
        if (count($positions) > 0) {
            foreach ($positions as $position) {
                $gender = $faker->randomElement(['male', 'female']);
                $firstName = $gender == 'male' ? $faker->unique(false, 100000)->firstNameMale : $faker->unique(false, 100000)->firstNameFemale;
                $lastName = $faker->lastName;

                $employee = new Employee([
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'gender' => $gender,
                    'birth_date' => $faker->date('Y-m-d', '1990-12-31'),
                    'position_id' => $position->id,
                    'shift_id' => 1,
                    'parent_id' => $parentId,
                ]);
                $employee->save();

                $this->createEmployeeByPositionLevel($faker, $level + 1, $employee->id);
            }
        } else {
            return;
        }
    }
}
