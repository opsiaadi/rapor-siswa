<?php

namespace App\Helpers;

/**
 * FakeDataHelper — Centralized session-based fake data manager.
 * All admin CRUD controllers use this so data is shared across modules.
 */
class FakeDataHelper
{
    // ── MAP ──

    public static function getMapel()
    {
        return session('fake_mapel', [
            ['id' => 1, 'kode_mapel' => 'MAT', 'nama_mapel' => 'Matematika', 'kkm' => 75],
            ['id' => 2, 'kode_mapel' => 'BIN', 'nama_mapel' => 'Bahasa Indonesia', 'kkm' => 78],
            ['id' => 3, 'kode_mapel' => 'IPA', 'nama_mapel' => 'Ilmu Pengetahuan Alam', 'kkm' => 75],
        ]);
    }

    public static function saveMapel($data) { session(['fake_mapel' => $data]); }

    public static function getMapelOptions()
    {
        return array_map(fn($m) => (object) $m, self::getMapel());
    }

    // ── GURU ──

    public static function getGuru()
    {
        $default = [
            ['id' => 1, 'nik' => '198501012010011001', 'nama' => 'Drs. Suryanto', 'email' => 'suryanto@sekolah.sch.id', 'mapel_ids' => [1, 4]],
            ['id' => 2, 'nik' => '198702022011012001', 'nama' => 'Rina Wulandari, S.Pd', 'email' => 'rina@sekolah.sch.id', 'mapel_ids' => [2]],
            ['id' => 3, 'nik' => '199003032015011001', 'nama' => 'Agus Prasetyo, M.Kom', 'email' => 'agus@sekolah.sch.id', 'mapel_ids' => [3]],
        ];
        $data = session('fake_guru', $default);
        
        // Migrate: ensure all guru have mapel_ids field
        $changed = false;
        foreach ($data as $key => $guru) {
            if (!isset($guru['mapel_ids'])) {
                $data[$key]['mapel_ids'] = [];
                $changed = true;
            }
        }
        if ($changed) {
            session(['fake_guru' => $data]);
        }
        
        return $data;
    }

    public static function saveGuru($data) { session(['fake_guru' => $data]); }

    public static function getGuruOptions()
    {
        return array_map(fn($g) => (object) $g, self::getGuru());
    }

    public static function findGuruByMapel($mapelId)
    {
        $guruList = self::getGuruOptions();
        foreach ($guruList as $guru) {
            $mapelIds = $guru->mapel_ids ?? [];
            if (in_array($mapelId, $mapelIds)) {
                return $guru;
            }
        }
        return null;
    }

    // ── KELAS ──

    public static function getKelas()
    {
        return session('fake_kelas', [
            ['id' => 1, 'nama_kelas' => 'X-RPL 1', 'tingkat' => 'X', 'wali_kelas_id' => 1, 'wali_nama' => 'Drs. Suryanto', 'siswa_count' => 30],
            ['id' => 2, 'nama_kelas' => 'X-RPL 2', 'tingkat' => 'X', 'wali_kelas_id' => 2, 'wali_nama' => 'Rina Wulandari, S.Pd', 'siswa_count' => 28],
            ['id' => 3, 'nama_kelas' => 'X-TKJ 1', 'tingkat' => 'X', 'wali_kelas_id' => 3, 'wali_nama' => 'Agus Prasetyo, M.Kom', 'siswa_count' => 25],
        ]);
    }

    public static function saveKelas($data) { session(['fake_kelas' => $data]); }

    public static function getKelasOptions()
    {
        return array_map(fn($k) => (object) $k, self::getKelas());
    }

    // ── SISWA ──

    public static function getSiswa()
    {
        return session('fake_siswa', [
            ['id' => 1, 'nis' => '2024001', 'nama' => 'Ahmad Fauzi', 'jenis_kelamin' => 'L', 'tahun_ajaran' => '2024/2025', 'kelas_id' => 1, 'kelas_nama' => 'X-RPL 1'],
            ['id' => 2, 'nis' => '2024002', 'nama' => 'Siti Nurhaliza', 'jenis_kelamin' => 'P', 'tahun_ajaran' => '2024/2025', 'kelas_id' => 1, 'kelas_nama' => 'X-RPL 1'],
            ['id' => 3, 'nis' => '2024003', 'nama' => 'Budi Santoso', 'jenis_kelamin' => 'L', 'tahun_ajaran' => '2024/2025', 'kelas_id' => 2, 'kelas_nama' => 'X-RPL 2'],
        ]);
    }

    public static function saveSiswa($data) { session(['fake_siswa' => $data]); }

    // ── HELPERS ──

    public static function nextId($collection)
    {
        return count($collection) > 0 ? max(array_column($collection, 'id')) + 1 : 1;
    }

    public static function findById($collection, $id)
    {
        return collect($collection)->firstWhere('id', (int) $id);
    }

    public static function removeById($collection, $id)
    {
        return array_values(array_filter($collection, fn($item) => $item['id'] != $id));
    }

    public static function updateById(&$collection, $id, $newData)
    {
        foreach ($collection as $key => $item) {
            if ($item['id'] == $id) {
                $collection[$key] = array_merge($item, $newData);
                return true;
            }
        }
        return false;
    }

    // ── DASHBOARD STATS ──

    public static function getDashboardStats()
    {
        return [
            'total_siswa' => count(self::getSiswa()),
            'total_guru'  => count(self::getGuru()),
            'total_mapel' => count(self::getMapel()),
            'total_kelas' => count(self::getKelas()),
        ];
    }

    public static function getRecentSiswa($limit = 5)
    {
        return array_slice(array_reverse(self::getSiswa()), 0, $limit);
    }
}
