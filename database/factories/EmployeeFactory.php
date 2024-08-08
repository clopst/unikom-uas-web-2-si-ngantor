<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gender = fake()->randomElement(['male', 'female']);

        return [
            'first_name' => fake('id_ID')->firstName($gender),
            'last_name' => fake('id_ID')->firstName($gender),
            'gender' => $gender,
            'birth_date' => fake('id_ID')->date('Y-m-d', '2000-01-01'),
            'shift_id' => 1,
        ];
    }
}
