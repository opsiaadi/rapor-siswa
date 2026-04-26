<?php

namespace App\Http\Controllers;

use App\Helpers\FakeDataHelper;

class WalikelasController extends Controller
{
    public function dashboard()
    {
        $id = 1;
        $namaGuru = 'Drs. Suryanto';

        $guru = FakeDataHelper::findById(FakeDataHelper::getGuru(), $id);
        $namaDisplay = $guru['nama'] ?? $namaGuru;

        $kelasList = collect(FakeDataHelper::getKelasOptions());
        $assignedClasses = $kelasList->filter(function ($kelas) use ($id, $namaDisplay) {
            if (is_numeric($id) && (int) ($kelas->wali_kelas_id ?? 0) === (int) $id) {
                return true;
            }
            return strcasecmp((string) ($kelas->wali_nama ?? ''), $namaDisplay) === 0;
        })->values();

        if ($assignedClasses->isEmpty()) {
            $assignedClasses = $kelasList->take(1)->values();
        }

        $kelasIds = $assignedClasses->pluck('id')->all();
        $siswaList = collect(FakeDataHelper::getSiswa())
            ->filter(fn ($siswa) => in_array($siswa['kelas_id'] ?? null, $kelasIds, true))
            ->map(fn ($siswa) => (object) $siswa)
            ->values();

        $selectedClass = $assignedClasses->first();
        $mapelCount = count(FakeDataHelper::getMapelByGuru($id));

        return view('walikelas.dashboard', [
            'id' => $id,
            'namaGuru' => $namaDisplay,
            'kelasList' => $kelasList,
            'assignedClasses' => $assignedClasses,
            'selectedClass' => $selectedClass,
            'siswaList' => $siswaList,
            'stats' => [
                'kelas_perwalian' => $assignedClasses->count(),
                'total_siswa' => $siswaList->count(),
                'mapel_diampu' => $mapelCount,
                'kelas_utama' => $selectedClass->nama_kelas ?? '-',
            ],
        ]);
    }

    public function finalisasi()
    {
        $id = 1;
        $namaGuru = 'Drs. Suryanto';

        $guru = FakeDataHelper::findById(FakeDataHelper::getGuru(), $id);
        $namaDisplay = $guru['nama'] ?? $namaGuru;

        $kelasList = collect(FakeDataHelper::getKelasOptions());
        $assignedClasses = $kelasList->filter(function ($kelas) use ($id, $namaDisplay) {
            if (is_numeric($id) && (int) ($kelas->wali_kelas_id ?? 0) === (int) $id) {
                return true;
            }
            return strcasecmp((string) ($kelas->wali_nama ?? ''), $namaDisplay) === 0;
        })->values();

        if ($assignedClasses->isEmpty()) {
            $assignedClasses = $kelasList->take(1)->values();
        }

        $selectedClass = $assignedClasses->first();

        return view('walikelas.form_finalisasi', [
            'id' => $id,
            'namaGuru' => $namaDisplay,
            'assignedClasses' => $assignedClasses,
            'kelasUtama' => $selectedClass,
        ]);
    }

    public function siswa()
    {
        $id = 1;
        $namaGuru = 'Drs. Suryanto';

        $guru = FakeDataHelper::findById(FakeDataHelper::getGuru(), $id);
        $namaDisplay = $guru['nama'] ?? $namaGuru;

        $kelasList = collect(FakeDataHelper::getKelasOptions());
        $assignedClasses = $kelasList->filter(function ($kelas) use ($id, $namaDisplay) {
            if (is_numeric($id) && (int) ($kelas->wali_kelas_id ?? 0) === (int) $id) {
                return true;
            }
            return strcasecmp((string) ($kelas->wali_nama ?? ''), $namaDisplay) === 0;
        })->values();

        if ($assignedClasses->isEmpty()) {
            $assignedClasses = $kelasList->take(1)->values();
        }

        $kelasIds = $assignedClasses->pluck('id')->all();
        $siswaList = collect(FakeDataHelper::getSiswa())
            ->filter(fn ($siswa) => in_array($siswa['kelas_id'] ?? null, $kelasIds, true))
            ->map(fn ($siswa) => (object) $siswa)
            ->values();

        return view('walikelas.data_siswa', [
            'id' => $id,
            'namaGuru' => $namaDisplay,
            'siswaList' => $siswaList,
            'assignedClasses' => $assignedClasses,
        ]);
    }

    public function ringkasan()
    {
        $id = 1;
        $namaGuru = 'Drs. Suryanto';

        $guru = FakeDataHelper::findById(FakeDataHelper::getGuru(), $id);
        $namaDisplay = $guru['nama'] ?? $namaGuru;

        $kelasList = collect(FakeDataHelper::getKelasOptions());
        $assignedClasses = $kelasList->filter(function ($kelas) use ($id, $namaDisplay) {
            if (is_numeric($id) && (int) ($kelas->wali_kelas_id ?? 0) === (int) $id) {
                return true;
            }
            return strcasecmp((string) ($kelas->wali_nama ?? ''), $namaDisplay) === 0;
        })->values();

        if ($assignedClasses->isEmpty()) {
            $assignedClasses = $kelasList->take(1)->values();
        }

        return view('walikelas.ringkasan_kelas', [
            'id' => $id,
            'namaGuru' => $namaDisplay,
            'assignedClasses' => $assignedClasses,
        ]);
    }
}