<?php

namespace Tests\Feature;

use App\Models\Kelas;
use App\Models\KelasMapel;
use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RaporKelasPindahanTest extends TestCase
{
    use RefreshDatabase;

    private function makeUser(string $role): User
    {
        return User::create([
            'nik' => fake()->unique()->numerify('##########'),
            'name' => fake()->name(),
            'nama' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => bcrypt('password'),
            'role' => $role,
            'status' => 'aktif',
        ]);
    }

    private function makeMapel(string $nama): Mapel
    {
        return Mapel::create([
            'kode_mapel' => strtolower($nama),
            'nama_mapel' => $nama,
            'kkm' => 75,
        ]);
    }

    public function test_rapor_siswa_pindahan_hanya_menampilkan_mapel_kelas_saat_ini(): void
    {
        $wali = $this->makeUser('walikelas');
        $guru = $this->makeUser('guru');

        $old1 = $this->makeMapel('Old Mapel Satu');
        $old2 = $this->makeMapel('Old Mapel Dua');
        $old3 = $this->makeMapel('Old Mapel Tiga');
        $new1 = $this->makeMapel('New Mapel Satu');
        $new2 = $this->makeMapel('New Mapel Dua');

        $kelasLama = Kelas::create([
            'nama_kelas' => 'Kelas Lama',
            'tingkat' => '1',
        ]);
        KelasMapel::create(['kelas_id' => $kelasLama->id, 'mapel_id' => $old1->id, 'guru_id' => $guru->id]);
        KelasMapel::create(['kelas_id' => $kelasLama->id, 'mapel_id' => $old2->id, 'guru_id' => $guru->id]);
        KelasMapel::create(['kelas_id' => $kelasLama->id, 'mapel_id' => $old3->id, 'guru_id' => $guru->id]);

        $kelasBaru = Kelas::create([
            'nama_kelas' => 'Kelas Baru',
            'tingkat' => '1',
            'wali_kelas_id' => $wali->id,
        ]);
        KelasMapel::create(['kelas_id' => $kelasBaru->id, 'mapel_id' => $new1->id, 'guru_id' => $guru->id]);
        KelasMapel::create(['kelas_id' => $kelasBaru->id, 'mapel_id' => $new2->id, 'guru_id' => $guru->id]);

        $siswa = Siswa::create([
            'nis' => '123456',
            'nama' => 'Siswa Pindahan',
            'jenis_kelamin' => 'L',
            'tahun_ajaran' => '2025/2026',
            'kelas_id' => $kelasBaru->id,
        ]);

        foreach ([$old1, $old2, $old3] as $mapel) {
            Nilai::create([
                'siswa_id' => $siswa->id,
                'mapel_id' => $mapel->id,
                'guru_id' => $guru->id,
                'semester' => '2',
                'harian' => 80,
                'uts' => 80,
                'uas' => 80,
                'nilai_akhir' => 80,
            ]);
        }

        // hanya satu mapel kelas baru yang sudah diisi (new1), new2 belum
        Nilai::create([
            'siswa_id' => $siswa->id,
            'mapel_id' => $new1->id,
            'guru_id' => $guru->id,
            'semester' => '2',
            'harian' => 80,
            'uts' => 80,
            'uas' => 80,
            'nilai_akhir' => 80,
        ]);

        $response = $this->actingAs($wali)->get(route('walikelas.rapor-lihat', ['siswaId' => $siswa->id, 'semester' => '2']));

        $response->assertOk();
        // kedua mapel kelas baru tampil, walau new2 belum punya nilai
        $response->assertSee('New Mapel Satu');
        $response->assertSee('New Mapel Dua');
        // mapel kelas lama tidak tampil
        $response->assertDontSee('Old Mapel Satu');
        $response->assertDontSee('Old Mapel Dua');
        $response->assertDontSee('Old Mapel Tiga');
    }

    public function test_hapus_kelas_tidak_menghapus_siswa_dan_nilai(): void
    {
        $guru = $this->makeUser('guru');

        $mapel = $this->makeMapel('Mapel Hapus');
        $kelas = Kelas::create([
            'nama_kelas' => 'Kelas Hapus',
            'tingkat' => '1',
        ]);
        KelasMapel::create(['kelas_id' => $kelas->id, 'mapel_id' => $mapel->id, 'guru_id' => $guru->id]);

        $siswa = Siswa::create([
            'nis' => '654321',
            'nama' => 'Siswa Bertahan',
            'jenis_kelamin' => 'P',
            'tahun_ajaran' => '2025/2026',
            'kelas_id' => $kelas->id,
        ]);

        $nilai = Nilai::create([
            'siswa_id' => $siswa->id,
            'mapel_id' => $mapel->id,
            'guru_id' => $guru->id,
            'semester' => '2',
            'nilai_akhir' => 90,
        ]);

        $kelas->delete();

        $this->assertDatabaseHas('siswa', ['id' => $siswa->id, 'kelas_id' => null]);
        $this->assertDatabaseHas('nilai', ['id' => $nilai->id, 'siswa_id' => $siswa->id]);
        $this->assertNull($siswa->fresh()->kelas_id);
    }
}
