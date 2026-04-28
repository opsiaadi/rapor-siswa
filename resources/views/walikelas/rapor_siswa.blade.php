@extends('layouts.walikelas', [
    'title' => 'Rapor Siswa - ' . ($siswa->nama ?? 'Siswa'),
    'pageTitle' => 'Rapor Siswa',
    'breadcrumb' => 'Rapor > Edit ' . ($siswa->nama ?? 'Siswa'),
    'id' => $id ?? 1,
    'namaGuru' => $namaGuru ?? 'Wali Kelas',
])

@section('content')
<div class="space-y-6">
    {{-- Student Info Card --}}
    <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <div class="flex items-center gap-4 mb-6">
            <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-emerald-500 to-cyan-500 text-xl font-bold text-white">
                {{ strtoupper(substr($siswa->nama ?? 'S', 0, 1)) }}
            </div>
            <div>
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">{{ $siswa->nama ?? '-' }}</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $siswa->nis ?? '-' }} • {{ $kelasUtama->nama_kelas ?? '-' }}</p>
            </div>
        </div>

        <div class="space-y-3">
            <div class="flex gap-2">
                <p class="text-xs font-medium text-gray-500 dark:text-gray-400 w-28">Wali Kelas</p>
                <p class="text-sm font-bold text-gray-900 dark:text-white">: {{ $namaGuru ?? 'Guru' }}</p>
            </div>
            <div class="flex gap-2">
                <p class="text-xs font-medium text-gray-500 dark:text-gray-400 w-28">Kelas</p>
                <p class="text-sm font-bold text-gray-900 dark:text-white">: {{ $kelasUtama->nama_kelas ?? '-' }}</p>
            </div>
        </div>
    </div>

    {{-- Rapor Form --}}
    <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Form Rapor Siswa</h3>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Lengkapi keterangan, kegiatan, absensi, dan tanda tangan untuk siswa ini.</p>
        </div>

        <form action="{{ route('walikelas.rapor.simpan', ['siswaId' => $siswa->id]) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div>
                <label for="keterangan" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Keterangan Siswa</label>
                <textarea id="keterangan" name="keterangan" rows="4" class="w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-gray-600 dark:bg-gray-900 dark:text-white" placeholder="Contoh: menunjukkan perkembangan yang konsisten dan siap naik kelas.">{{ old('keterangan', $siswa->keterangan ?? '') }}</textarea>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <label for="kegiatan" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Kegiatan</label>
                    <input id="kegiatan" type="text" name="kegiatan" value="{{ old('kegiatan', $siswa->kegiatan ?? '') }}" class="w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-red-500 focus:ring-red-500" placeholder="Pramuka, Paskibra, PMR">
                </div>
                <div>
                    <label for="ket_kegiatan" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Keterangan Kegiatan</label>
                    <input id="ket_kegiatan" type="text" name="ket_kegiatan" value="{{ old('ket_kegiatan', $siswa->ket_kegiatan ?? '') }}" class="w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-red-500 focus:ring-red-500" placeholder="Aktif dan disiplin">
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                <div>
                    <label for="izin" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Izin</label>
                    <input id="izin" type="number" min="0" name="izin" value="{{ old('izin', $siswa->izin ?? 0) }}" class="w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" placeholder="0">
                </div>
                <div>
                    <label for="sakit" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Sakit</label>
                    <input id="sakit" type="number" min="0" name="sakit" value="{{ old('sakit', $siswa->sakit ?? 0) }}" class="w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" placeholder="0">
                </div>
                <div>
                    <label for="alpha" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Tanpa Keterangan</label>
                    <input id="alpha" type="number" min="0" name="alpha" value="{{ old('alpha', $siswa->alpha ?? 0) }}" class="w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" placeholder="0">
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                <div>
                    <label for="nama" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Penandatangan</label>
                    <input id="nama" type="text" name="nama" value="{{ old('nama', $namaGuru ?? 'Wali Kelas') }}" class="w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" placeholder="Nama wali kelas">
                </div>
                <div>
                    <label for="role" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Peran</label>
                    <input id="role" type="text" name="role" value="{{ old('role', 'Wali Kelas') }}" class="w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" placeholder="Wali Kelas">
                </div>
                <div>
                    <label for="ttd" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Upload Tanda Tangan</label>
                    <input id="ttd" type="file" name="ttd" class="block w-full rounded-2xl border border-dashed border-gray-300 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm file:mr-4 file:rounded-full file:border-0 file:bg-emerald-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-emerald-700 hover:file:bg-emerald-100">
                </div>
            </div>

            <div class="flex flex-col gap-3 border-t border-gray-100 pt-5 sm:flex-row sm:items-center sm:justify-between dark:border-gray-700">
                <div class="flex items-center gap-3">
                    <a href="{{ route('walikelas.finalisasi') }}" class="inline-flex items-center justify-center rounded-full border border-gray-200 px-5 py-2.5 text-sm font-semibold text-gray-600 transition hover:bg-gray-50 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center justify-center rounded-full bg-gradient-to-r from-blue-600 to-teal-500 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-emerald-200 transition hover:opacity-95 dark:shadow-none">
                        Simpan Rapor
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
