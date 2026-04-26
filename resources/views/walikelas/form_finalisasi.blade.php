@extends('layouts.walikelas', [
    'title' => 'Finalisasi Rapor Wali Kelas',
    'pageTitle' => 'Finalisasi Rapor',
    'breadcrumb' => 'Form finalisasi rapor untuk ' . ($namaGuru ?? 'Wali Kelas'),
    'id' => $id ?? 1,
    'namaGuru' => $namaGuru ?? 'Wali Kelas',
])

@section('content')
<div class="space-y-6">
    <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Form Finalisasi Rapor</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Lengkapi catatan akhir, kegiatan, absensi, dan tanda tangan wali kelas.</p>
            </div>
            <span class="inline-flex rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700 dark:bg-emerald-900/20 dark:text-emerald-300">
                Status: Siap diproses
            </span>
        </div>

        <form action="{{ route('rapor.simpan') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            <input type="hidden" name="wali_kelas_id" value="{{ $id ?? '' }}">
            <input type="hidden" name="wali_kelas_nama" value="{{ $namaGuru ?? 'Wali Kelas' }}">

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <label for="kelas_id" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Kelas Perwalian</label>
                    <select id="kelas_id" name="kelas_id" class="w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-gray-600 dark:bg-gray-900 dark:text-white">
                        @forelse($assignedClasses ?? [] as $kelas)
                            <option value="{{ $kelas->id }}" {{ old('kelas_id', $kelasUtama->id ?? null) == $kelas->id ? 'selected' : '' }}>
                                {{ $kelas->nama_kelas }} - {{ $kelas->tingkat }}
                            </option>
                        @empty
                            <option value="">Belum ada kelas perwalian</option>
                        @endforelse
                    </select>
                </div>
                <div>
                    <label for="semester" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Semester</label>
                    <select id="semester" name="semester" class="w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-gray-600 dark:bg-gray-900 dark:text-white">
                        <option value="ganjil">Ganjil</option>
                        <option value="genap" selected>Genap</option>
                    </select>
                </div>
            </div>

            <div>
                <label for="keterangan" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Keterangan Siswa</label>
                <textarea id="keterangan" name="keterangan" rows="4" class="w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-gray-600 dark:bg-gray-900 dark:text-white" placeholder="Contoh: menunjukkan perkembangan yang konsisten dan siap naik kelas.">{{ old('keterangan') }}</textarea>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <label for="kegiatan" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300"> kegiatan</label>
                    <input id="kegiatan" type="text" name="kegiatan" value="{{ old('kegatan') }}" class="w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-red-500 focus:ring-red-500" placeholder="Pramuka, Paskibra, PMR">
                </div>
                <div>
                    <label for="ket_kegatan" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Keterangan Kegiatan</label>
                    <input id="ket_kegatan" type="text" name="ket_kegatan" value="{{ old('ket_kegatan') }}" class="w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-red-500 focus:ring-red-500" placeholder="Aktif dan disiplin">
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                <div>
                    <label for="izin" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Izin</label>
                    <input id="izin" type="number" min="0" name="izin" value="{{ old('izin') }}" class="w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" placeholder="0">
                </div>
                <div>
                    <label for="sakit" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Sakit</label>
                    <input id="sakit" type="number" min="0" name="sakit" value="{{ old('sakit') }}" class="w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" placeholder="0">
                </div>
                <div>
                    <label for="alpha" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Tanpa Keterangan</label>
                    <input id="alpha" type="number" min="0" name="alpha" value="{{ old('alpha') }}" class="w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" placeholder="0">
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
                    <a href="{{ route('walikelas.dashboard') }}" class="inline-flex items-center justify-center rounded-full border border-gray-200 px-5 py-2.5 text-sm font-semibold text-gray-600 transition hover:bg-gray-50 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700">
                        Reset
                    </a>
                    <button type="submit" class="inline-flex items-center justify-center rounded-full bg-gradient-to-r from-blue-600 to-teal-500 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-emerald-200 transition hover:opacity-95 dark:shadow-none">
                        Simpan Finalisasi
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection