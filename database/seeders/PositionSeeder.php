<?php

// 10123909 - Andi Tegar Permadi

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'CEO',
                'level' => 1,
            ],
            [
                'name' => 'Head of HR',
                'level' => 2,
            ],
            [
                'name' => 'Head of Marketing',
                'level' => 2,
            ],
            [
                'name' => 'Head of Development',
                'level' => 2,
            ],
            [
                'name' => 'HR Manager',
                'level' => 3,
            ],
            [
                'name' => 'Marketing Manager',
                'level' => 3,
            ],
            [
                'name' => 'Senior Developer',
                'level' => 3,
            ],
            [
                'name' => 'HR Specialist',
                'level' => 4,
            ],
            [
                'name' => 'Marketing Specialist',
                'level' => 4,
            ],
            [
                'name' => 'Junior Developer',
                'level' => 4,
            ],
            [
                'name' => 'Customer Service',
                'level' => 5,
            ],
        ];

        foreach ($data as $item) {
            Position::create($item);
        }
    }
}
