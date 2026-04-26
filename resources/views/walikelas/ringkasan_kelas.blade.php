@extends('layouts.walikelas', [
    'title' => 'Ringkasan Kelas Wali Kelas',
    'pageTitle' => 'Ringkasan Kelas',
    'breadcrumb' => 'Daftar kelas perwalian untuk ' . ($namaGuru ?? 'Wali Kelas'),
    'id' => $id ?? 1,
    'namaGuru' => $namaGuru ?? 'Wali Kelas',
])

@section('content')
<div class="space-y-6">
    <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Ringkasan Kelas</h3>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Daftar kelas yang menjadi tanggung jawab wali kelas.</p>

        <div class="mt-5 space-y-3">
            @forelse($assignedClasses ?? [] as $kelas)
                <div class="rounded-2xl border border-emerald-100 bg-emerald-50/70 px-4 py-3 dark:border-emerald-900 dark:bg-emerald-900/10">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <p class="font-semibold text-gray-900 dark:text-white">{{ $kelas->nama_kelas }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Tingkat {{ $kelas->tingkat }} • {{ $kelas->wali_nama ?? $namaGuru }}</p>
                        </div>
                        <span class="rounded-full bg-white px-2.5 py-1 text-xs font-semibold text-emerald-700 shadow-sm dark:bg-gray-800 dark:text-emerald-300">
                            {{ $kelas->siswa_count ?? 0 }} siswa
                        </span>
                    </div>
                </div>
            @empty
                <div class="rounded-2xl border border-dashed border-gray-300 px-4 py-5 text-sm text-gray-500 dark:border-gray-600 dark:text-gray-400">
                    Belum ada kelas yang terhubung dengan wali kelas ini.
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection