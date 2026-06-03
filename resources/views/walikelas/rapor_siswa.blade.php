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
    <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
        <div class="flex items-center gap-4 mb-6">
            <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-emerald-500 to-cyan-500 text-xl font-bold text-white">
                {{ strtoupper(substr($siswa->nama ?? 'S', 0, 1)) }}
            </div>
            <div>
                <h2 class="text-xl font-bold text-gray-900">{{ $siswa->nama ?? '-' }}</h2>
                <p class="text-sm text-gray-500">{{ $siswa->nis ?? '-' }} • {{ $kelasUtama->nama_kelas ?? '-' }}</p>
            </div>
        </div>

        <div class="space-y-3">
            <div class="flex gap-2">
                <p class="text-xs font-medium text-gray-500 w-28">Wali Kelas</p>
                <p class="text-sm font-bold text-gray-900">: {{ $namaGuru ?? 'Guru' }}</p>
            </div>
            <div class="flex gap-2">
                <p class="text-xs font-medium text-gray-500 w-28">Kelas</p>
                <p class="text-sm font-bold text-gray-900">: {{ $kelasUtama->nama_kelas ?? '-' }}</p>
            </div>
        </div>
    </div>

    {{-- Rapor Form --}}
    <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
        <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-900">Form Rapor Siswa</h3>
            <p class="mt-1 text-sm text-gray-500">Lengkapi keterangan, kegiatan, absensi, dan tanda tangan untuk siswa ini.</p>
        </div>

        <form action="{{ route('walikelas.rapor.simpan', ['siswaId' => $siswa->id]) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div>
                <label for="keterangan" class="mb-2 block text-sm font-medium text-gray-700">Keterangan Siswa</label>
                <textarea id="keterangan" name="keterangan" rows="4" class="w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" placeholder="Contoh: menunjukkan perkembangan yang konsisten dan siap naik kelas.">{{ old('keterangan', $siswa->keterangan ?? '') }}</textarea>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <label for="kegatan" class="mb-2 block text-sm font-medium text-gray-700"> Kegiatan</label>
                    <input id="kegatan" type="text" name="kegatan" value="{{ old('kegatan', $siswa->kegatan ?? '') }}" class="w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-red-500 focus:ring-red-500" placeholder="Pramuka, Paskibra, PMR">
                </div>
                <div>
                    <label for="ket_kegatan" class="mb-2 block text-sm font-medium text-gray-700">Keterangan Kegiatan</label>
                    <input id="ket_kegatan" type="text" name="ket_kegatan" value="{{ old('ket_kegatan', $siswa->ket_kegatan ?? '') }}" class="w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-red-500 focus:ring-red-500" placeholder="Aktif dan disiplin">
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                <div>
                    <label for="izin" class="mb-2 block text-sm font-medium text-gray-700">Izin</label>
                    <input id="izin" type="number" min="0" name="izin" value="{{ old('izin', $siswa->izin ?? 0) }}" class="w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" placeholder="0">
                </div>
                <div>
                    <label for="sakit" class="mb-2 block text-sm font-medium text-gray-700">Sakit</label>
                    <input id="sakit" type="number" min="0" name="sakit" value="{{ old('sakit', $siswa->sakit ?? 0) }}" class="w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" placeholder="0">
                </div>
                <div>
                    <label for="alpha" class="mb-2 block text-sm font-medium text-gray-700">Tanpa Keterangan</label>
                    <input id="alpha" type="number" min="0" name="alpha" value="{{ old('alpha', $siswa->alpha ?? 0) }}" class="w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" placeholder="0">
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <label for="nama" class="mb-2 block text-sm font-medium text-gray-700">Nama Penandatangan</label>
                    <input id="nama" type="text" name="nama" value="{{ old('nama', $namaGuru ?? 'Wali Kelas') }}" class="w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" placeholder="Nama wali kelas">
                </div>
                <div>
                    <label for="role" class="mb-2 block text-sm font-medium text-gray-700">Peran</label>
                    <input id="role" type="text" name="role" value="{{ old('role', 'Wali Kelas') }}" class="w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" placeholder="Wali Kelas">
                </div>
            </div>

            <div class="flex flex-col gap-3 border-t border-gray-100 pt-5 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex items-center gap-3">
                    <a href="{{ route('walikelas.finalisasi') }}" class="inline-flex items-center justify-center rounded-full border border-gray-200 px-5 py-2.5 text-sm font-semibold text-gray-600 transition-all duration-200 hover:bg-gray-50 hover:scale-105 active:scale-95">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center justify-center rounded-full bg-gradient-to-r from-blue-600 to-teal-500 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-emerald-200 transition-all duration-200 hover:scale-105 active:scale-95">
                        Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection