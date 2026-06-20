<?php

namespace Database\Seeders;

use App\Models\Ekstrakurikuler;
use Illuminate\Database\Seeder;

class EkstrakurikulerSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama' => 'Pramuka', 'is_aktif' => true],
            ['nama' => 'Paskibra', 'is_aktif' => true],
            ['nama' => 'PMR', 'is_aktif' => true],
            ['nama' => 'OSIS', 'is_aktif' => true],
            ['nama' => 'Ekstra Olahraga', 'is_aktif' => true],
            ['nama' => 'Ekstra Seni', 'is_aktif' => true],
        ];

        foreach ($data as $item) {
            Ekstrakurikuler::create($item);
        }
    }
}
