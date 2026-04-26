@extends('layouts.walikelas', [
    'title' => 'Data Siswa Wali Kelas',
    'pageTitle' => 'Data Siswa',
    'breadcrumb' => 'Data siswa kelas perwalian untuk ' . ($namaGuru ?? 'Wali Kelas'),
    'id' => $id ?? 1,
    'namaGuru' => $namaGuru ?? 'Wali Kelas',
])

@section('content')
<div class="space-y-6">
    <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <div class="flex items-center justify-between gap-3">
            <div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Siswa Perwalian</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Data siswa dari kelas utama yang diawasi.</p>
            </div>
            <span class="rounded-full bg-teal-50 px-3 py-1 text-xs font-semibold text-teal-700 dark:bg-teal-900/20 dark:text-teal-300">
                {{ count($siswaList ?? []) }} siswa
            </span>
        </div>

        <div class="mt-5 space-y-3">
            @forelse(($siswaList ?? collect()) as $siswa)
                <div class="flex items-center justify-between rounded-2xl border border-gray-100 px-4 py-3 dark:border-gray-700">
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-gradient-to-br from-emerald-500 to-cyan-500 text-sm font-semibold text-white">
                            {{ strtoupper(substr($siswa->nama ?? 'S', 0, 1)) }}
                        </div>
                        <div>
                            <p class="font-medium text-gray-900 dark:text-white">{{ $siswa->nama ?? '-' }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $siswa->nis ?? '-' }} • {{ $siswa->kelas_nama ?? '-' }}</p>
                        </div>
                    </div>
                    <span class="rounded-full bg-teal-50 px-2.5 py-1 text-xs font-semibold text-teal-700 dark:bg-teal-900/20 dark:text-teal-300">
                        {{ $siswa->jenis_kelamin ?? '-' }}
                    </span>
                </div>
            @empty
                <div class="rounded-2xl border border-dashed border-gray-300 px-4 py-5 text-sm text-gray-500 dark:border-gray-600 dark:text-gray-400">
                    Data siswa untuk kelas perwalian belum tersedia.
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection