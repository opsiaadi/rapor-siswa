<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class GuruFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nik' => $this->faker->unique()->numerify('##############'),
            'nama' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password'),
        ];
    }
}
