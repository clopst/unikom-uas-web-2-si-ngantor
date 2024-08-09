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
        $direktur = new Position([
            'name' => 'Direktur',
        ]);
        $direktur->save();

        $manager = new Position([
            'parent_id' => $direktur->id,
            'name' => 'Manager',
        ]);
        $manager->save();

        $staff = new Position([
            'parent_id' => $manager->id,
            'name' => 'Staff',
        ]);
        $staff->save();
    }
}
