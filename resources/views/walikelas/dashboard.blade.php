@extends('layouts.walikelas', [
    'title' => 'Dashboard Wali Kelas',
    'pageTitle' => 'Dashboard Wali Kelas',
    'breadcrumb' => 'Ringkasan kelas perwalian untuk ' . ($namaGuru ?? 'Wali Kelas'),
    'id' => $id ?? 1,
    'namaGuru' => $namaGuru ?? 'Wali Kelas',
])

@section('content')
<div class="space-y-6">
    <section class="rounded-3xl bg-cyan-600 px-8 py-8 text-white shadow-lg">
        <div class="flex flex-col gap-8 lg:flex-row lg:items-center lg:justify-between">
            <div class="max-w-2xl">
                <p class="text-xs font-semibold uppercase tracking-[0.35em] text-cyan-200">Dashboard Wali Kelas</p>
                <h2 class="mt-3 text-3xl font-bold sm:text-4xl">Selamat Datang, {{ $namaGuru }}</h2>
                <p class="mt-4 text-base leading-7 text-cyan-100">
                    Berikut adalah ringkasan keadaan kelas perwalian Anda saat ini.
                </p>
            </div>

            <div class="grid grid-cols-2 gap-4 text-sm sm:min-w-[300px]">
                <div class="rounded-2xl bg-cyan-700 px-5 py-5">
                    <p class="text-cyan-200 text-sm">Wali Kelas</p>
                    <p class="mt-2 text-lg font-semibold text-white">{{ $namaGuru }}</p>
                </div>
                <div class="rounded-2xl bg-cyan-700 px-5 py-5">
                    <p class="text-cyan-200 text-sm">Kelas Utama</p>
                    <p class="mt-2 text-lg font-semibold text-white">{{ $selectedClass->nama_kelas ?? '-' }}</p>
                </div>
            </div>
        </div>
    </section>

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
        <div class="rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Kelas Diampu</p>
                    <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['kelas_perwalian'] ?? 0 }}</p>
                </div>
                <div class="rounded-2xl bg-emerald-100 p-3 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Siswa</p>
                    <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['total_siswa'] ?? 0 }}</p>
                </div>
                <div class="rounded-2xl bg-emerald-100 p-3 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Mapel Diampu</p>
                    <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['mapel_diampu'] ?? 0 }}</p>
                </div>
                <div class="rounded-2xl bg-emerald-100 p-3 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection