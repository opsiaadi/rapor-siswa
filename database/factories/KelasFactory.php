<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class KelasFactory extends Factory
{
    public function definition(): array
    {
        $tingkat = $this->faker->randomElement(['X', 'XI', 'XII']);
        $jurusan = $this->faker->randomElement(['RPL', 'TKJ', 'MM']);
        $nomor = $this->faker->numberBetween(1, 3);
        
        return [
            'nama_kelas' => "{$tingkat}-{$jurusan} {$nomor}",
            'tingkat' => $tingkat,
            'wali_kelas_id' => null, // akan diisi di seeder
        ];
    }
}
