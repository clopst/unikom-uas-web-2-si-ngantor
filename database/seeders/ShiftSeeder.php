<?php

// 10123910 - Gilbert Santoso

namespace Database\Seeders;

use App\Models\Shift;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pagi = new Shift([
            'name' => 'Shift Pagi',
            'in' => '09:00:00',
            'out' => '17:00:00',
            'tolerance' => 15,
        ]);
        $pagi->save();

        $siang = new Shift([
            'name' => 'Shift Siang',
            'in' => '13:00:00',
            'out' => '21:00:00',
            'tolerance' => 15,
        ]);
        $siang->save();
    }
}
