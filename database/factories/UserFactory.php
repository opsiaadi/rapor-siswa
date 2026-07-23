<?php

namespace Database\Factories;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'nik' => fake()->unique()->numerify('##########'),
            'name' => fake()->name(),
            'nama' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => 'password',
            'role' => UserRole::Guru,
            'status' => 'aktif',
        ];
    }

    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => UserRole::Admin,
        ]);
    }

    public function guru(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => UserRole::Guru,
        ]);
    }

    public function walikelas(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => UserRole::Walikelas,
        ]);
    }
}
