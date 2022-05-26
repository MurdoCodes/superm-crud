<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Student;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Student::class;

    public function definition()
    {
        return [
            'fullname' => $this->faker->name(),
            'contact' => $this->faker->phoneNumber(),
            'region' => $this->faker->Address(),
            'course_id' => $this->faker->numberBetween($min = 1, $max = 10),
            'section_id' => $this->faker->numberBetween($min = 1, $max = 10),
            'status_id' => $this->faker->numberBetween($min = 1, $max = 10),
        ];
    }
}
