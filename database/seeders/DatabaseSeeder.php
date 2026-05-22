<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Siswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // 1. Admin
        Admin::factory(3)->create();

        // 2. Mapel
        $mapels = Mapel::factory(7)->create();

        // 3. Guru
        $gurus = Guru::factory(5)->create();

        // 4. Attach mapel ke guru (setiap guru mengajar 1-2 mapel)
        foreach ($gurus as $guru) {
            $randomMapels = $mapels->random(rand(1, 2));
            $guru->mapels()->attach($randomMapels->pluck('id')->toArray());
        }

        // 5. Buat Kelas
        $kelas = Kelas::factory(3)->create([
            'wali_kelas_id' => $gurus->random()->id
        ]);

        // 6. Buat Siswa
        foreach ($kelas as $kls) {
            Siswa::factory(rand(5, 10))->create([
                'kelas_id' => $kls->id
            ]);
        }

        // 7. Fix plain text passwords
        $count = 0;

        $admins = Admin::all();
        foreach ($admins as $admin) {
            $password = $admin->password;
            if (!preg_match('/^\$2[ayb]\$/', $password)) {
                $admin->password = Hash::make($password);
                $admin->save();
                $count++;
            }
        }

        $gurus = Guru::all();
        foreach ($gurus as $guru) {
            $password = $guru->password;
            if (!preg_match('/^\$2[ayb]\$/', $password)) {
                $guru->password = Hash::make($password);
                $guru->save();
                $count++;
            }
        }

        if ($count > 0) {
            echo "Total passwords fixed: $count\n";
        }
    }
}
