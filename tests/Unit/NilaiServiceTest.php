<?php

namespace Tests\Unit;

use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\User;
use App\Services\NilaiMapperService;
use App\Services\NilaiService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NilaiServiceTest extends TestCase
{
    use RefreshDatabase;

    private function makeService(): NilaiService
    {
        return new NilaiService(new NilaiMapperService);
    }

    private function makeMapel(int $kkm = 75): Mapel
    {
        $mapel = new Mapel;
        $mapel->kode_mapel = 'TST';
        $mapel->nama_mapel = 'Test Mapel';
        $mapel->kkm = $kkm;
        $mapel->save();

        return $mapel;
    }

    private function makeSiswa(): Siswa
    {
        $kelas = new Kelas;
        $kelas->nama_kelas = 'X';
        $kelas->tingkat = 'X';
        $kelas->save();

        $siswa = new Siswa;
        $siswa->nis = '123';
        $siswa->nama = 'Budi';
        $siswa->jenis_kelamin = 'L';
        $siswa->tahun_ajaran = '2025';
        $siswa->kelas_id = $kelas->id;
        $siswa->save();

        return $siswa;
    }

    private function makeGuru(): User
    {
        return User::factory()->create();
    }

    public function test_nilai_akhir_normalisasi_tanpa_uas(): void
    {
        $mapel = $this->makeMapel(75);
        $siswa = $this->makeSiswa();
        $guru = $this->makeGuru();

        $this->makeService()->saveNilaiBatch([
            'harian' => [$siswa->id => '80'],
            'uts' => [$siswa->id => '90'],
            'uas' => [$siswa->id => ''],
        ], $mapel->id, '1', (object) ['id' => $guru->id]);

        $nilai = Nilai::where('siswa_id', $siswa->id)
            ->where('mapel_id', $mapel->id)
            ->where('semester', '1')
            ->first();

        // (80*0.4 + 90*0.3) / 0.7 = 84.3
        $this->assertEquals(84.3, $nilai->nilai_akhir);
    }

    public function test_nilai_di_bawah_kkm_tetap_tidak_lulus(): void
    {
        $mapel = $this->makeMapel(75);
        $siswa = $this->makeSiswa();
        $guru = $this->makeGuru();

        $this->makeService()->saveNilaiBatch([
            'harian' => [$siswa->id => '45'],
            'uts' => [$siswa->id => '30'],
            'uas' => [$siswa->id => ''],
        ], $mapel->id, '1', (object) ['id' => $guru->id]);

        $nilai = Nilai::where('siswa_id', $siswa->id)
            ->where('mapel_id', $mapel->id)
            ->where('semester', '1')
            ->first();

        // (45*0.4 + 30*0.3) / 0.7 = 38.6
        $this->assertEquals(38.6, $nilai->nilai_akhir);
    }

    public function test_nilai_akhir_dengan_semua_komponen_sama_dengan_rumus_lama(): void
    {
        $mapel = $this->makeMapel(75);
        $siswa = $this->makeSiswa();
        $guru = $this->makeGuru();

        $this->makeService()->saveNilaiBatch([
            'harian' => [$siswa->id => '100'],
            'uts' => [$siswa->id => '100'],
            'uas' => [$siswa->id => '100'],
        ], $mapel->id, '1', (object) ['id' => $guru->id]);

        $nilai = Nilai::where('siswa_id', $siswa->id)
            ->where('mapel_id', $mapel->id)
            ->where('semester', '1')
            ->first();

        // (100*0.4 + 100*0.3 + 100*0.3) / 1 = 100
        $this->assertEquals(100.0, $nilai->nilai_akhir);
    }

    public function test_nilai_akhir_null_ketika_semua_kosong(): void
    {
        $mapel = $this->makeMapel(75);
        $siswa = $this->makeSiswa();
        $guru = $this->makeGuru();

        $this->makeService()->saveNilaiBatch([
            'harian' => [$siswa->id => ''],
            'uts' => [$siswa->id => ''],
            'uas' => [$siswa->id => ''],
        ], $mapel->id, '1', (object) ['id' => $guru->id]);

        $nilai = Nilai::where('siswa_id', $siswa->id)
            ->where('mapel_id', $mapel->id)
            ->where('semester', '1')
            ->first();

        $this->assertNull($nilai->nilai_akhir);
    }

    public function test_status_kkm_mengikuti_ambang_75(): void
    {
        $mapel = $this->makeMapel(75);
        $siswa = $this->makeSiswa();
        $guru = $this->makeGuru();

        $this->makeService()->saveNilaiBatch([
            'harian' => [$siswa->id => '80'],
            'uts' => [$siswa->id => '90'],
            'uas' => [$siswa->id => ''],
        ], $mapel->id, '1', (object) ['id' => $guru->id]);

        $result = $this->makeService()->getSiswaNilaiForEdit(
            (string) $siswa->kelas_id,
            (string) $mapel->id,
            '1'
        )->firstWhere('id', $siswa->id);

        $this->assertNotNull($result);
        $this->assertEquals('lulus', $result->status_kkm);
    }
}
