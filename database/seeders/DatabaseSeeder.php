<?php

namespace Database\Seeders;

use App\Enums\JenisKelamin;
use App\Enums\RoleAdmin;
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
        Admin::create([
            'nama' => 'Admin Utama',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => RoleAdmin::SuperAdmin,
            'status' => 'aktif',
        ]);

        // 2. Mapel
        $mapelData = [
            ['kode_mapel' => 'MAT', 'nama_mapel' => 'Matematika', 'kkm' => 75],
            ['kode_mapel' => 'BIN', 'nama_mapel' => 'Bahasa Indonesia', 'kkm' => 78],
            ['kode_mapel' => 'BIG', 'nama_mapel' => 'Bahasa Inggris', 'kkm' => 75],
            ['kode_mapel' => 'IPA', 'nama_mapel' => 'Ilmu Pengetahuan Alam', 'kkm' => 75],
            ['kode_mapel' => 'IPS', 'nama_mapel' => 'Ilmu Pengetahuan Sosial', 'kkm' => 75],
            ['kode_mapel' => 'PJK', 'nama_mapel' => 'Pendidikan Jasmani', 'kkm' => 70],
            ['kode_mapel' => 'TIK', 'nama_mapel' => 'Teknologi Informasi', 'kkm' => 75],
        ];
        $mapels = collect();
        foreach ($mapelData as $data) {
            $mapels->push(Mapel::create($data));
        }

        // 3. Guru
        $guruData = [
            ['nik' => '12345678901234', 'nama' => 'Budi Santoso', 'email' => 'budi@example.com', 'password' => Hash::make('password')],
            ['nik' => '12345678901235', 'nama' => 'Siti Aminah', 'email' => 'siti@example.com', 'password' => Hash::make('password')],
            ['nik' => '12345678901236', 'nama' => 'Ahmad Rizal', 'email' => 'ahmad@example.com', 'password' => Hash::make('password')],
            ['nik' => '12345678901237', 'nama' => 'Dewi Lestari', 'email' => 'dewi@example.com', 'password' => Hash::make('password')],
            ['nik' => '12345678901238', 'nama' => 'Rudi Hermawan', 'email' => 'rudi@example.com', 'password' => Hash::make('password')],
        ];
        $gurus = collect();
        foreach ($guruData as $data) {
            $gurus->push(Guru::create($data));
        }

        // 4. Attach mapel ke guru (setiap guru mengajar 1-2 mapel)
        foreach ($gurus as $guru) {
            $randomMapels = $mapels->random(rand(1, 2));
            $guru->mapels()->attach($randomMapels->pluck('id')->toArray());
        }

        // 5. Buat Kelas
        $kelasData = [
            ['nama_kelas' => 'X-RPL 1', 'tingkat' => 'X'],
            ['nama_kelas' => 'XI-TKJ 2', 'tingkat' => 'XI'],
            ['nama_kelas' => 'XII-MM 3', 'tingkat' => 'XII'],
        ];
        $kelas = collect();
        foreach ($kelasData as $data) {
            $kelas->push(Kelas::create([
                ...$data,
                'wali_kelas_id' => $gurus->random()->id,
            ]));
        }

        // 6. Buat Siswa
        $siswaTemplate = [
            ['nama' => 'Andi Pratama', 'jenis_kelamin' => JenisKelamin::L, 'tahun_ajaran' => '2024/2025'],
            ['nama' => 'Bella Khairunisa', 'jenis_kelamin' => JenisKelamin::P, 'tahun_ajaran' => '2024/2025'],
            ['nama' => 'Citra Dewi', 'jenis_kelamin' => JenisKelamin::P, 'tahun_ajaran' => '2024/2025'],
            ['nama' => 'Doni Saputra', 'jenis_kelamin' => JenisKelamin::L, 'tahun_ajaran' => '2024/2025'],
            ['nama' => 'Eka Putri', 'jenis_kelamin' => JenisKelamin::P, 'tahun_ajaran' => '2024/2025'],
        ];
        $nisCounter = 900000;
        foreach ($kelas as $kls) {
            foreach ($siswaTemplate as $data) {
                Siswa::create(['nis' => $nisCounter++, ...$data, 'kelas_id' => $kls->id]);
            }
        }
    }
}
