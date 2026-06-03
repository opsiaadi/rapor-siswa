<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MapelFactory extends Factory
{
    public function definition(): array
    {
        $mapelList = [
            ['kode_mapel' => 'MAT', 'nama_mapel' => 'Matematika', 'kkm' => 75],
            ['kode_mapel' => 'BIN', 'nama_mapel' => 'Bahasa Indonesia', 'kkm' => 78],
            ['kode_mapel' => 'BIG', 'nama_mapel' => 'Bahasa Inggris', 'kkm' => 75],
            ['kode_mapel' => 'IPA', 'nama_mapel' => 'Ilmu Pengetahuan Alam', 'kkm' => 75],
            ['kode_mapel' => 'IPS', 'nama_mapel' => 'Ilmu Pengetahuan Sosial', 'kkm' => 75],
            ['kode_mapel' => 'PJK', 'nama_mapel' => 'Pendidikan Jasmani', 'kkm' => 70],
            ['kode_mapel' => 'TIK', 'nama_mapel' => 'Teknologi Informasi', 'kkm' => 75],
        ];
        
        $mapel = $this->faker->randomElement($mapelList);
        
        return [
            'kode_mapel' => $mapel['kode_mapel'] . $this->faker->unique()->randomNumber(1),
            'nama_mapel' => $mapel['nama_mapel'],
            'kkm' => $mapel['kkm'],
        ];
    }
}
