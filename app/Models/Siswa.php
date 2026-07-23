<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Siswa extends Model
{
    const L = 'L';

    const P = 'P';

    const RAPOR_BELUM = 'belum';

    const RAPOR_SUDAH = 'sudah';

    protected $table = 'siswa';

    protected $fillable = [
        'nis',
        'nama',
        'jenis_kelamin',
        'tahun_ajaran',
        'kelas_id',
        'keterangan',
        'keterangan_extra',
        'kegiatan',
        'ket_kegiatan',
        'izin',
        'sakit',
        'alpha',
        'status_rapor',
    ];

    protected function casts(): array
    {
        return [
            'jenis_kelamin' => 'string',
            'status_rapor' => 'string',
        ];
    }

    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class);
    }

    public static function findByKelasId(int $kelasId): Collection
    {
        return static::where('kelas_id', $kelasId)->get();
    }

    public static function findWithKelasByKelasIds(array $kelasIds): Collection
    {
        return static::with('kelas')->whereIn('kelas_id', $kelasIds)->get();
    }

    public static function findByIdInKelasIds(int $id, array $kelasIds): ?self
    {
        return static::with('kelas')->where('id', $id)
            ->whereIn('kelas_id', $kelasIds)->first();
    }

    public static function pluckIdsByKelasIds(array $kelasIds): array
    {
        return static::whereIn('kelas_id', $kelasIds)->pluck('id')->toArray();
    }

    public static function toDaftar(self $siswa): object
    {
        return (object) [
            'id' => $siswa->id,
            'nis' => $siswa->nis,
            'nama' => $siswa->nama,
            'jenis_kelamin' => $siswa->jenis_kelamin ?? '-',
            'kelas_nama' => $siswa->kelas ? $siswa->kelas->nama_kelas : '-',
        ];
    }

    public function getAbsensi(string $semester): array
    {
        $extra = is_string($this->keterangan_extra) ? json_decode($this->keterangan_extra, true) : ($this->keterangan_extra ?? []);
        $absensi = $extra['absensi'] ?? [];

        return $absensi[$semester] ?? ['izin' => 0, 'sakit' => 0, 'alpha' => 0];
    }

    public function setAbsensi(string $semester, int $izin, int $sakit, int $alpha): void
    {
        $extra = is_string($this->keterangan_extra) ? json_decode($this->keterangan_extra, true) : ($this->keterangan_extra ?? []);
        if (! is_array($extra)) {
            $extra = [];
        }
        $extra['absensi'][$semester] = ['izin' => $izin, 'sakit' => $sakit, 'alpha' => $alpha];
        $this->update(['keterangan_extra' => json_encode($extra)]);
    }

    public static function toRaporDetail(self $siswa, string $semester = '2'): object
    {
        $abs = $siswa->getAbsensi($semester);
        $extra = is_string($siswa->keterangan_extra) ? json_decode($siswa->keterangan_extra, true) : ($siswa->keterangan_extra ?? []);

        return (object) [
            'id' => $siswa->id,
            'nis' => $siswa->nis,
            'nama' => $siswa->nama,
            'jenis_kelamin' => $siswa->jenis_kelamin ?? '-',
            'tahun_ajaran' => $siswa->tahun_ajaran ?? '-',
            'kelas_nama' => $siswa->kelas ? $siswa->kelas->nama_kelas : '-',
            'keterangan' => $siswa->keterangan ?? '',
            'keterangan_extra' => $extra['catatan_lain'] ?? '',
            'kegiatan' => $siswa->kegiatan ?? '',
            'ket_kegiatan' => $siswa->ket_kegiatan ?? '',
            'izin' => $abs['izin'],
            'sakit' => $abs['sakit'],
            'alpha' => $abs['alpha'],
        ];
    }

    public static function toDataSiswa(self $siswa, float|string $rata_rata): object
    {
        return (object) [
            'id' => $siswa->id,
            'nis' => $siswa->nis,
            'nama' => $siswa->nama,
            'jenis_kelamin' => $siswa->jenis_kelamin ?? '-',
            'tahun_ajaran' => $siswa->tahun_ajaran ?? '-',
            'kelas_id' => $siswa->kelas_id,
            'kelas' => $siswa->kelas
                ? (object) ['nama_kelas' => $siswa->kelas->nama_kelas]
                : (object) ['nama_kelas' => '-'],
            'keterangan' => $siswa->keterangan ?? '',
            'keterangan_extra' => $siswa->keterangan_extra ?? '',
            'izin' => $siswa->izin ?? 0,
            'sakit' => $siswa->sakit ?? 0,
            'alpha' => $siswa->alpha ?? 0,
            'status_rapor' => $siswa->status_rapor ?? 'belum',
            'nilai_rata_rata' => $rata_rata,
        ];
    }
}
