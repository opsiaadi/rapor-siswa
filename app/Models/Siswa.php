<?php

namespace App\Models;

use App\Enums\JenisKelamin;
use App\Enums\StatusRapor;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Siswa extends Model
{
    protected $table = 'siswa';

    protected $fillable = [
        'nis',
        'nama',
        'jenis_kelamin',
        'tahun_ajaran',
        'kelas_id',
        'keterangan',
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
            'jenis_kelamin' => JenisKelamin::class,
            'status_rapor' => StatusRapor::class,
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
            'jenis_kelamin' => $siswa->jenis_kelamin?->value ?? '-',
            'kelas_nama' => $siswa->kelas ? $siswa->kelas->nama_kelas : '-',
        ];
    }

    public static function toRaporDetail(self $siswa): object
    {
        return (object) [
            'id' => $siswa->id,
            'nis' => $siswa->nis,
            'nama' => $siswa->nama,
            'jenis_kelamin' => $siswa->jenis_kelamin?->value ?? '-',
            'tahun_ajaran' => $siswa->tahun_ajaran ?? '-',
            'kelas_nama' => $siswa->kelas ? $siswa->kelas->nama_kelas : '-',
            'keterangan' => $siswa->keterangan ?? '',
            'keterangan_extra' => $siswa->keterangan_extra ?? '',
            'kegiatan' => $siswa->kegiatan ?? '',
            'ket_kegiatan' => $siswa->ket_kegiatan ?? '',
            'izin' => $siswa->izin ?? 0,
            'sakit' => $siswa->sakit ?? 0,
            'alpha' => $siswa->alpha ?? 0,
        ];
    }

    public static function toDataSiswa(self $siswa, float|string $rata_rata): object
    {
        return (object) [
            'id' => $siswa->id,
            'nis' => $siswa->nis,
            'nama' => $siswa->nama,
            'jenis_kelamin' => $siswa->jenis_kelamin?->value ?? '-',
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
            'status_rapor' => $siswa->status_rapor?->value ?? 'belum',
            'nilai_rata_rata' => $rata_rata,
        ];
    }
}
