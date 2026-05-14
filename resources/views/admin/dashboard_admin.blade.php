@extends('layouts.admin', [
    'title' => 'Dashboard',
    'pageTitle' => 'Dashboard Admin',
    'userName' => $nama ?? 'Admin TU'
])

@section('content')
<div class="space-y-6">
    <!-- Welcome Banner -->
    <div class="p-4 mb-6 text-white bg-gradient-to-br from-cyan-600 via-teal-500 to-emerald-600 rounded-lg shadow-sm   " role="alert">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-bold">Selamat Datang, {{ $nama ?? 'Admin' }}! 👋</h2>
                <p class="text-sm text-white/80 mt-1">Kelola data siswa, guru, mata pelajaran, dan kelas dengan mudah.</p>
                <div class="flex items-center gap-2 mt-3 text-xs text-white/70">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <span>ID Admin: {{ $id ?? 'N/A' }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Total Siswa -->
        <div class="w-full p-4 bg-white rounded-lg border border-gray-200 shadow-sm   hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 ">Total Siswa</p>
                    <p class="text-2xl font-bold text-gray-900  mt-1">{{ $stats['total_siswa'] ?? 0 }}</p>
                </div>
                <div class="p-3 bg-blue-100  rounded-lg flex items-center justify-center">
                    <img src="{{ asset('images/icons8-group-96.png') }}" alt="Siswa" class="w-8 h-8">
                </div>
            </div>
        </div>

        <!-- Total Guru -->
        <div class="w-full p-4 bg-white rounded-lg border border-gray-200 shadow-sm   hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 ">Total Guru</p>
                    <p class="text-2xl font-bold text-gray-900  mt-1">{{ $stats['total_guru'] ?? 0 }}</p>
                </div>
                <div class="p-3 bg-purple-100  rounded-lg flex items-center justify-center">
                    <img src="{{ asset('images/icons8-customer-48.png') }}" alt="Guru" class="w-8 h-8">
                </div>
            </div>
        </div>

        <!-- Total Mapel -->
        <div class="w-full p-4 bg-white rounded-lg border border-gray-200 shadow-sm   hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 ">Mata Pelajaran</p>
                    <p class="text-2xl font-bold text-gray-900  mt-1">{{ $stats['total_mapel'] ?? 0 }}</p>
                </div>
                <div class="p-3 bg-amber-100  rounded-lg flex items-center justify-center">
                    <img src="{{ asset('images/icons8-open-book-100.png') }}" alt="Mapel" class="w-8 h-8">
                </div>
            </div>
        </div>

        <!-- Total Kelas -->
        <div class="w-full p-4 bg-white rounded-lg border border-gray-200 shadow-sm   hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 ">Total Kelas</p>
                    <p class="text-2xl font-bold text-gray-900  mt-1">{{ $stats['total_kelas'] ?? 0 }}</p>
                </div>
                <div class="p-3 bg-emerald-100  rounded-lg flex items-center justify-center">
                    <img src="{{ asset('images/icons8-school-building-64.png') }}" alt="Kelas" class="w-8 h-8">
                </div>
            </div>
        </div>
    </div>

    <!-- Siswa Terbaru & Statistik Cepat -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Siswa Terbaru (Kiri - 2 kolom) -->
        <div class="lg:col-span-2 p-4 bg-white rounded-lg border border-gray-200 shadow-sm  ">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-base font-semibold text-gray-900 ">Siswa Terbaru</h3>
            <a href="/admin/siswa" class="text-sm text-blue-600  hover:underline font-medium flex items-center gap-1">
                Lihat Semua
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
                    <tr>
                        <th scope="col" class="px-5 py-3">Nama Siswa</th>
                        <th scope="col" class="px-5 py-3">NIS</th>
                        <th scope="col" class="px-5 py-3">Kelas</th>
                        <th scope="col" class="px-5 py-3">Status</th>
                        <th scope="col" class="px-5 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentSiswa ?? [] as $s)
                    <tr class="bg-white border-b   hover:bg-gray-50 ">
                        <td class="px-5 py-3">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center text-white text-xs font-semibold">
                                    {{ strtoupper(substr($s->nama ?? 'U', 0, 1)) }}
                                </div>
                                <span class="text-sm font-medium text-gray-900 ">{{ $s->nama ?? '-' }}</span>
                            </div>
                        </td>
                        <td class="px-5 py-3 font-mono">{{ $s->nis ?? '-' }}</td>
                        <td class="px-5 py-3">
                            <span class="bg-blue-100 text-blue-800   text-xs font-medium px-2.5 py-0.5 rounded">{{ $s->kelas_nama ?? '-' }}</span>
                        </td>
                        <td class="px-5 py-3">
                            <span class="bg-green-100 text-green-800   text-xs font-medium px-2.5 py-0.5 rounded-full">Aktif</span>
                        </td>
                        <td class="px-5 py-3 text-center">
                            <button type="button"
                                    onclick="openDetailModal('{{ strtoupper(substr($s->nama ?? 'S', 0, 1)) }}', '{{ $s->nama ?? '-' }}', '{{ $s->nis ?? '-' }}', '{{ $s->jenis_kelamin ?? '-' }}', '{{ $s->tahun_ajaran ?? '-' }}', '{{ $s->kelas_nama ?? '-' }}', '{{ $s->wali_nama ?? '-' }}')"
                                    class="inline-flex items-center justify-center p-2 text-blue-600 hover:text-blue-700 hover:bg-blue-50    rounded-lg transition-colors"
                                    title="Detail Siswa">
                                    <svg class="w-6 h-6 text-sky-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M4.998 7.78C6.729 6.345 9.198 5 12 5c2.802 0 5.27 1.345 7.002 2.78a12.713 12.713 0 0 1 2.096 2.183c.253.344.465.682.618.997.14.286.284.658.284 1.04s-.145.754-.284 1.04a6.6 6.6 0 0 1-.618.997 12.712 12.712 0 0 1-2.096 2.183C17.271 17.655 14.802 19 12 19c-2.802 0-5.27-1.345-7.002-2.78a12.712 12.712 0 0 1-2.096-2.183 6.6 6.6 0 0 1-.618-.997C2.144 12.754 2 12.382 2 12s.145-.754.284-1.04c.153-.315.365-.653.618-.997A12.714 12.714 0 0 1 4.998 7.78ZM12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" clip-rule="evenodd"/>
                                    </svg>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-5 py-12 text-center text-gray-500 ">Belum ada data siswa</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        </div>

        <!-- Statistik Cepat (Kanan - 1 kolom) -->
        <div class="p-4 bg-white rounded-lg border border-gray-200 shadow-sm  ">
            <h3 class="text-base font-semibold text-gray-900  mb-4">Statistik Cepat</h3>
            <div class="space-y-3">
                @php
                    $totalSiswa = $stats['total_siswa'] ?? 0;
                    $totalGuru = $stats['total_guru'] ?? 0;
                    $avgPerKelas = ($stats['total_kelas'] ?? 0) > 0 ? round($totalSiswa / ($stats['total_kelas'] ?? 1)) : 0;
                @endphp
                <div class="flex items-center justify-between p-3 bg-blue-50  rounded-lg">
                    <span class="text-sm text-gray-600 ">Rata-rata Siswa/Kelas</span>
                    <span class="text-lg font-bold text-gray-900 ">{{ $avgPerKelas }}</span>
                </div>
                <div class="flex items-center justify-between p-3 bg-purple-50  rounded-lg">
                    <span class="text-sm text-gray-600 ">Total Guru</span>
                    <span class="text-lg font-bold text-gray-900 ">{{ $totalGuru }}</span>
                </div>
                <div class="flex items-center justify-between p-3 bg-amber-50  rounded-lg">
                    <span class="text-sm text-gray-600 ">Total Mapel</span>
                    <span class="text-lg font-bold text-gray-900 ">{{ $stats['total_mapel'] ?? 0 }}</span>
                </div>
                <div class="flex items-center justify-between p-3 bg-emerald-50  rounded-lg">
                    <span class="text-sm text-gray-600 ">Total Kelas</span>
                    <span class="text-lg font-bold text-gray-900 ">{{ $stats['total_kelas'] ?? 0 }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Detail Modal -->
    <div id="detailModal" tabindex="-1" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm overflow-y-auto">
        <div class="relative bg-white  rounded-xl shadow-2xl w-full max-w-2xl mx-4 border border-gray-200 ">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-5 border-b border-gray-200  bg-gradient-to-r from-emerald-600 to-green-700   rounded-t-xl">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center text-white font-bold text-lg ring-2 ring-white/30" id="modalAvatar">
                        A
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-white" id="modalName">Nama Siswa</h3>
                    </div>
                </div>
                <button onclick="closeDetailModal()" class="text-white hover:bg-white/20 rounded-lg p-2 transition-colors">
                    <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M4.998 7.78C6.729 6.345 9.198 5 12 5c2.802 0 5.27 1.345 7.002 2.78a12.713 12.713 0 0 1 2.096 2.183c.253.344.465.682.618.997.14.286.284.658.284 1.04s-.145.754-.284 1.04a6.6 6.6 0 0 1-.618.997 12.712 12.712 0 0 1-2.096 2.183C17.271 17.655 14.802 19 12 19c-2.802 0-5.27-1.345-7.002-2.78a12.712 12.712 0 0 1-2.096-2.183 6.6 6.6 0 0 1-.618-.997C2.144 12.754 2 12.382 2 12s.145-.754.284-1.04c.153-.315.365-.653.618-.997A12.714 12.714 0 0 1 4.998 7.78ZM12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-6 space-y-5 max-h-[60vh] overflow-y-auto">
                <!-- Detail Siswa -->
                <div class="bg-gray-50  rounded-lg p-4">
                    <h4 class="text-sm font-bold text-gray-900  uppercase tracking-wider mb-3 flex items-center gap-2">
                        <svg class="w-6 h-6 text-blue-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z" clip-rule="evenodd"/>
                        </svg>
                        Detail Siswa
                    </h4>
                    <div class="space-y-3 text-sm">
                        <div class="flex items-start gap-3">
                            <span class="text-xs font-medium text-gray-500  w-32 shrink-0">NIS</span>
                            <span class="font-semibold text-gray-900  font-mono" id="modalNIS">-</span>
                        </div>
                        <div class="border-t border-gray-100 "></div>
                        <div class="flex items-start gap-3">
                            <span class="text-xs font-medium text-gray-500  w-32 shrink-0">Nama Siswa</span>
                            <span class="font-semibold text-gray-900 " id="modalName2">-</span>
                        </div>
                        <div class="border-t border-gray-100 "></div>
                        <div class="flex items-start gap-3">
                            <span class="text-xs font-medium text-gray-500  w-32 shrink-0">Jenis Kelamin</span>
                            <span class="font-semibold text-gray-900 " id="modalGender">-</span>
                        </div>
                        <div class="border-t border-gray-100 "></div>
                        <div class="flex items-start gap-3">
                            <span class="text-xs font-medium text-gray-500  w-32 shrink-0">Tahun Ajaran</span>
                            <span class="font-semibold text-gray-900 " id="modalTahunAjaran">-</span>
                        </div>
                        <div class="border-t border-gray-100 "></div>
                        <div class="flex items-start gap-3">
                            <span class="text-xs font-medium text-gray-500  w-32 shrink-0">Kelas</span>
                            <span class="font-semibold text-gray-900 " id="modalKelas">-</span>
                        </div>
                        <div class="border-t border-gray-100 "></div>
                        <div class="flex items-start gap-3">
                            <span class="text-xs font-medium text-gray-500  w-32 shrink-0">Wali Kelas</span>
                            <span class="font-semibold text-gray-900 " id="modalWaliKelas">-</span>
                        </div>
                        <div class="border-t border-gray-100 "></div>
                        <div class="flex items-start gap-3">
                            <span class="text-xs font-medium text-gray-500  w-32 shrink-0">Status</span>
                            <span class="inline-flex items-center gap-1 bg-green-100  text-green-800  text-xs font-medium px-2.5 py-1 rounded-full">
                                <div class="w-2 h-2 rounded-full bg-green-500"></div>
                                Aktif
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="flex items-center justify-end p-5 border-t border-gray-200  bg-gray-50  rounded-b-xl">
                <button onclick="closeDetailModal()" class="px-4 py-2 text-sm font-medium text-gray-700  bg-white  border border-gray-300  rounded-lg hover:bg-gray-100  transition-colors">
                    Tutup
                </button>
            </div>
        </div>
    </div>
@endsection
