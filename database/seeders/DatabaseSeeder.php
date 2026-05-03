<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Siswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // 1. Buat Admin
        Admin::factory(3)->create();

        // 2. Buat Mapel (5-7 mapel)
        $mapels = Mapel::factory(7)->create();

        // 3. Buat Guru (5 guru)
        $gurus = Guru::factory(5)->create();

        // 4. Attach mapel ke guru (setiap guru mengajar 1-2 mapel)
        foreach ($gurus as $guru) {
            $randomMapels = $mapels->random(rand(1, 2));
            $guru->mapels()->attach($randomMapels->pluck('id')->toArray());
        }

        // 5. Buat Kelas (3 kelas, isi wali_kelas_id)
        $kelas = Kelas::factory(3)->create([
            'wali_kelas_id' => $gurus->random()->id
        ]);

        // 6. Buat Siswa (20 siswa, isi kelas_id)
        foreach ($kelas as $kls) {
            Siswa::factory(rand(5, 10))->create([
                'kelas_id' => $kls->id
            ]);
        }
    }
}
