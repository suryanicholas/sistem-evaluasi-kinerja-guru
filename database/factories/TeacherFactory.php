<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'alias' => 'ABC',
            'code' => fake()->regexify('[0-9]{18}'),
            'teaching' => fake()->word(),
            'gender' => 'male',
            'email' => fake()->email(),
            'phone' => fake()->regexify('[0-9]{12}'),
            'address' => fake()->city(),
            'image' => null,
        ];
    }
}