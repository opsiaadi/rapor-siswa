<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class SiswaFactory extends Factory
{
    public function definition(): array
    {
        $tahunAjaran = $this->faker->randomElement(['2023/2024', '2024/2025', '2025/2026']);
        
        return [
            'nis' => $this->faker->unique()->numerify('#########'),
            'nama' => $this->faker->name(),
            'jenis_kelamin' => $this->faker->randomElement(['L', 'P']),
            'tahun_ajaran' => $tahunAjaran,
            'kelas_id' => null, // akan diisi lewat seeder
        ];
    }
}
