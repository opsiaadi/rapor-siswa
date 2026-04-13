@extends('layouts.admin', [
    'title' => 'Dashboard',
    'pageTitle' => 'Dashboard',
    'breadcrumb' => 'Selamat datang, ' . ($nama ?? 'Admin') . ' di sistem pengolahan rapor siswa',
    'userName' => $nama ?? 'Admin TU'
])

@section('content')
<div class="space-y-6">
    <!-- Welcome Banner - Flowbite Alert Style -->
    <div class="p-4 mb-6 text-white bg-gradient-to-br from-cyan-600 via-teal-500 to-emerald-600 rounded-lg shadow-sm dark:from-cyan-700 dark:via-teal-600 dark:to-emerald-700" role="alert">
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

    <!-- Stats Cards - Flowbite Card Style -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Total Siswa -->
        <div class="w-full p-4 bg-white rounded-lg border border-gray-200 shadow-sm dark:bg-gray-800 dark:border-gray-700 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Siswa</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">{{ $stats['total_siswa'] ?? 0 }}</p>
                </div>
                <div class="p-3 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                    <img src="{{ asset('storage/icons/icons8-group-96.png') }}" alt="Siswa" class="w-8 h-8">
                </div>
            </div>
        </div>

        <!-- Total Guru -->
        <div class="w-full p-4 bg-white rounded-lg border border-gray-200 shadow-sm dark:bg-gray-800 dark:border-gray-700 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Guru</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">{{ $stats['total_guru'] ?? 0 }}</p>
                </div>
                <div class="p-3 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center">
                    <img src="{{ asset('storage/icons/icons8-customer-48.png') }}" alt="Guru" class="w-8 h-8">
                </div>
            </div>
        </div>

        <!-- Total Mapel -->
        <div class="w-full p-4 bg-white rounded-lg border border-gray-200 shadow-sm dark:bg-gray-800 dark:border-gray-700 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Mata Pelajaran</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">{{ $stats['total_mapel'] ?? 0 }}</p>
                </div>
                <div class="p-3 bg-amber-100 dark:bg-amber-900/30 rounded-lg flex items-center justify-center">
                    <img src="{{ asset('storage/icons/icons8-open-book-100.png') }}" alt="Mapel" class="w-8 h-8">
                </div>
            </div>
        </div>

        <!-- Total Kelas -->
        <div class="w-full p-4 bg-white rounded-lg border border-gray-200 shadow-sm dark:bg-gray-800 dark:border-gray-700 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Kelas</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">{{ $stats['total_kelas'] ?? 0 }}</p>
                </div>
                <div class="p-3 bg-emerald-100 dark:bg-emerald-900/30 rounded-lg flex items-center justify-center">
                    <img src="{{ asset('storage/icons/icons8-school-building-64.png') }}" alt="Kelas" class="w-8 h-8">
                </div>
            </div>
        </div>
    </div>

    <!-- Charts & Quick Stats -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        <!-- Bar Chart -->
        <div class="lg:col-span-2 p-5 bg-white rounded-lg border border-gray-200 shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-base font-semibold text-gray-900 dark:text-white">Jumlah Siswa Per Kelas</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Distribusi siswa tahun ajaran aktif</p>
                </div>
                <div class="flex items-center gap-2">
                    <label for="tahun_ajaran" class="text-xs font-medium text-gray-500 dark:text-gray-400">Tahun Ajaran:</label>
                    <select id="tahun_ajaran" onchange="changeTahunAjaran(this.value)"
                        class="text-xs font-medium text-emerald-700 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 rounded-lg px-3 py-1.5 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 cursor-pointer">
                        @foreach($tahunAjaranList as $ta)
                        <option value="{{ $ta }}" {{ $selectedTA == $ta ? 'selected' : '' }}>{{ $ta }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @php
                $gradientColors = [
                    'from-blue-500 to-blue-600',
                    'from-purple-500 to-purple-600',
                    'from-pink-500 to-pink-600',
                    'from-amber-500 to-amber-600',
                    'from-emerald-500 to-emerald-600',
                    'from-cyan-500 to-cyan-600',
                    'from-indigo-500 to-indigo-600',
                    'from-rose-500 to-rose-600',
                ];
                $maxSiswa = max(array_column($kelasPerKelas, 'siswa_count') ?: [1]);
            @endphp
            @if($totalSiswa > 0)
            <!-- Chart Container with Grid Lines -->
            <div class="relative">
                <!-- Horizontal Grid Lines -->
                <div class="absolute inset-0 flex flex-col justify-between pointer-events-none pb-8">
                    <div class="border-b border-dashed border-gray-100 dark:border-gray-700/50 w-full"></div>
                    <div class="border-b border-dashed border-gray-100 dark:border-gray-700/50 w-full"></div>
                    <div class="border-b border-dashed border-gray-100 dark:border-gray-700/50 w-full"></div>
                    <div class="border-b border-dashed border-gray-100 dark:border-gray-700/50 w-full"></div>
                </div>

                <!-- Bars -->
                <div class="flex items-end gap-4 h-52 px-2 relative z-10">
                    @foreach($kelasPerKelas as $idx => $k)
                    @php
                        $barHeight = max(8, (($k->siswa_count ?? 0) / max($maxSiswa, 1)) * 100);
                        $percentage = $totalSiswa > 0 ? round((($k->siswa_count ?? 0) / $totalSiswa) * 100) : 0;
                    @endphp
                    <div class="flex-1 flex flex-col items-center gap-2 group">
                        <!-- Tooltip on Hover -->
                        <div class="opacity-0 group-hover:opacity-100 transition-opacity absolute -top-12 bg-gray-900 dark:bg-gray-700 text-white text-xs font-semibold px-2.5 py-1.5 rounded-lg shadow-lg whitespace-nowrap z-20 pointer-events-none">
                            {{ $k->siswa_count ?? 0 }} siswa ({{ $percentage }}%)
                            <div class="absolute top-full left-1/2 -translate-x-1/2 -mt-px">
                                <div class="border-4 border-transparent border-t-gray-900 dark:border-t-gray-700"></div>
                            </div>
                        </div>

                        <!-- Count Label -->
                        <span class="text-sm font-bold text-gray-800 dark:text-gray-200 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">{{ $k->siswa_count ?? 0 }}</span>

                        <!-- Bar -->
                        <div class="w-full relative rounded-t-lg overflow-hidden shadow-sm bg-gradient-to-t {{ $gradientColors[$idx % count($gradientColors)] }}" style="height: {{ $barHeight }}%">
                            <!-- Shine Effect -->
                            <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0"></div>
                        </div>

                        <!-- Class Name -->
                        <span class="text-xs font-medium text-gray-600 dark:text-gray-400 text-center truncate w-full group-hover:text-gray-900 dark:group-hover:text-gray-200 transition-colors">{{ $k->nama_kelas }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Summary -->
            <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700 flex items-center justify-between text-xs">
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-1.5">
                        <div class="w-2.5 h-2.5 rounded-full bg-emerald-500"></div>
                        <span class="text-gray-500 dark:text-gray-400">Total: <strong class="text-gray-900 dark:text-white">{{ $totalSiswa }} siswa</strong> ({{ $selectedTA ?? '2024/2025' }})</span>
                    </div>
                </div>
                <span class="text-gray-400 dark:text-gray-500">{{ count($kelasPerKelas) }} kelas aktif</span>
            </div>
            @else
            <div class="text-center py-12">
                <div class="w-16 h-16 mx-auto mb-4 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center">
                    <svg class="w-8 h-8 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <p class="text-gray-400 dark:text-gray-500 font-medium">Tidak ada data siswa untuk tahun ajaran {{ $selectedTA ?? '2024/2025' }}</p>
                <p class="text-xs text-gray-400 dark:text-gray-600 mt-1">Tambahkan kelas terlebih dahulu</p>
            </div>
            @endif
        </div>

        <!-- Quick Stats -->
        <div class="p-4 bg-white rounded-lg border border-gray-200 shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-4">Statistik Cepat</h3>
            <div class="space-y-3">
                @php
                    $totalSiswa = $stats['total_siswa'] ?? 0;
                    $totalGuru = $stats['total_guru'] ?? 0;
                    $avgPerKelas = ($stats['total_kelas'] ?? 0) > 0 ? round($totalSiswa / ($stats['total_kelas'] ?? 1)) : 0;
                @endphp
                <div class="flex items-center justify-between p-3 bg-blue-50 dark:bg-blue-900/10 rounded-lg">
                    <span class="text-sm text-gray-600 dark:text-gray-400">Rata-rata Siswa/Kelas</span>
                    <span class="text-lg font-bold text-gray-900 dark:text-gray-100">{{ $avgPerKelas }}</span>
                </div>
                <div class="flex items-center justify-between p-3 bg-purple-50 dark:bg-purple-900/10 rounded-lg">
                    <span class="text-sm text-gray-600 dark:text-gray-400">Total Guru</span>
                    <span class="text-lg font-bold text-gray-900 dark:text-gray-100">{{ $totalGuru }}</span>
                </div>
                <div class="flex items-center justify-between p-3 bg-amber-50 dark:bg-amber-900/10 rounded-lg">
                    <span class="text-sm text-gray-600 dark:text-gray-400">Total Mapel</span>
                    <span class="text-lg font-bold text-gray-900 dark:text-gray-100">{{ $stats['total_mapel'] ?? 0 }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Students Table - Flowbite Table Style -->
    <div class="p-4 bg-white rounded-lg border border-gray-200 shadow-sm dark:bg-gray-800 dark:border-gray-700">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-base font-semibold text-gray-900 dark:text-white">Siswa Terbaru</h3>
            <a href="/admin/siswa" class="text-sm text-blue-600 dark:text-blue-400 hover:underline font-medium flex items-center gap-1">
                Lihat Semua
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-300">
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
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                        <td class="px-5 py-3">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center text-white text-xs font-semibold">
                                    {{ strtoupper(substr($s->nama ?? 'U', 0, 1)) }}
                                </div>
                                <span class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $s->nama ?? '-' }}</span>
                            </div>
                        </td>
                        <td class="px-5 py-3 font-mono">{{ $s->nis ?? '-' }}</td>
                        <td class="px-5 py-3">
                            <span class="bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300 text-xs font-medium px-2.5 py-0.5 rounded">{{ $s->kelas_nama ?? '-' }}</span>
                        </td>
                        <td class="px-5 py-3">
                            <span class="bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300 text-xs font-medium px-2.5 py-0.5 rounded-full">Aktif</span>
                        </td>
                        <td class="px-5 py-3 text-center">
                            <button type="button"
                                    onclick="openDetailModal({{ json_encode([
                                        'id' => $s->id ?? '',
                                        'nama' => $s->nama ?? '-',
                                        'nis' => $s->nis ?? '-',
                                        'jenis_kelamin' => $s->jenis_kelamin ?? '-',
                                        'tahun_ajaran' => $s->tahun_ajaran ?? '-',
                                        'kelas_nama' => $s->kelas_nama ?? '-',
                                        'wali_nama' => $s->wali_nama ?? '-',
                                    ]) }})"
                                    class="inline-flex items-center justify-center p-2 text-blue-600 hover:text-blue-700 hover:bg-blue-50 dark:text-blue-400 dark:hover:text-blue-300 dark:hover:bg-blue-900/20 rounded-lg transition-colors"
                                    title="Detail Siswa">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-5 py-12 text-center text-gray-500 dark:text-gray-400">Belum ada data siswa</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Detail Modal (Flowbite Modal) -->
    <div id="detailModal" tabindex="-1" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm overflow-y-auto">
        <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-2xl w-full max-w-2xl mx-4 border border-gray-200 dark:border-gray-700">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-5 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-emerald-600 to-green-700 dark:from-emerald-700 dark:to-green-800 rounded-t-xl">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center text-white font-bold text-lg ring-2 ring-white/30" id="modalAvatar">
                        A
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-white" id="modalName">Nama Siswa</h3>
                        <p class="text-xs text-emerald-100/80" id="modalClass">Kelas -</p>
                    </div>
                </div>
                <button onclick="closeDetailModal()" class="text-white hover:bg-white/20 rounded-lg p-2 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-6 space-y-5 max-h-[60vh] overflow-y-auto">
                <!-- Detail Siswa -->
                <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4">
                    <h4 class="text-sm font-bold text-gray-900 dark:text-white uppercase tracking-wider mb-3 flex items-center gap-2">
                        <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Detail Siswa
                    </h4>
                    <div class="space-y-3 text-sm">
                        <div class="flex items-start gap-3">
                            <span class="text-xs font-medium text-gray-500 dark:text-gray-400 w-32 shrink-0">NIS</span>
                            <span class="font-semibold text-gray-900 dark:text-white font-mono" id="modalNIS">-</span>
                        </div>
                        <div class="border-t border-gray-100 dark:border-gray-700"></div>
                        <div class="flex items-start gap-3">
                            <span class="text-xs font-medium text-gray-500 dark:text-gray-400 w-32 shrink-0">Nama Siswa</span>
                            <span class="font-semibold text-gray-900 dark:text-white" id="modalName2">-</span>
                        </div>
                        <div class="border-t border-gray-100 dark:border-gray-700"></div>
                        <div class="flex items-start gap-3">
                            <span class="text-xs font-medium text-gray-500 dark:text-gray-400 w-32 shrink-0">Jenis Kelamin</span>
                            <span class="font-semibold text-gray-900 dark:text-white" id="modalGender">-</span>
                        </div>
                        <div class="border-t border-gray-100 dark:border-gray-700"></div>
                        <div class="flex items-start gap-3">
                            <span class="text-xs font-medium text-gray-500 dark:text-gray-400 w-32 shrink-0">Tahun Ajaran</span>
                            <span class="font-semibold text-gray-900 dark:text-white" id="modalTahunAjaran">-</span>
                        </div>
                        <div class="border-t border-gray-100 dark:border-gray-700"></div>
                        <div class="flex items-start gap-3">
                            <span class="text-xs font-medium text-gray-500 dark:text-gray-400 w-32 shrink-0">Kelas</span>
                            <span class="font-semibold text-gray-900 dark:text-white" id="modalKelas">-</span>
                        </div>
                        <div class="border-t border-gray-100 dark:border-gray-700"></div>
                        <div class="flex items-start gap-3">
                            <span class="text-xs font-medium text-gray-500 dark:text-gray-400 w-32 shrink-0">Wali Kelas</span>
                            <span class="font-semibold text-gray-900 dark:text-white" id="modalWaliKelas">-</span>
                        </div>
                        <div class="border-t border-gray-100 dark:border-gray-700"></div>
                        <div class="flex items-start gap-3">
                            <span class="text-xs font-medium text-gray-500 dark:text-gray-400 w-32 shrink-0">Status</span>
                            <span class="inline-flex items-center gap-1 bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300 text-xs font-medium px-2.5 py-1 rounded-full">
                                <div class="w-2 h-2 rounded-full bg-green-500"></div>
                                Aktif
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="flex items-center justify-end p-5 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/30 rounded-b-xl">
                <button onclick="closeDetailModal()" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <!-- Modal JavaScript -->
    <script>
        function changeTahunAjaran(ta) {
            const url = new URL(window.location.href);
            url.searchParams.set('tahun_ajaran', ta);
            window.location.href = url.toString();
        }

        function openDetailModal(siswa) {
            const modal = document.getElementById('detailModal');
            const initial = (siswa.nama || 'U').charAt(0).toUpperCase();

            document.getElementById('modalAvatar').textContent = initial;
            document.getElementById('modalName').textContent = siswa.nama || '-';
            document.getElementById('modalName2').textContent = siswa.nama || '-';
            document.getElementById('modalClass').textContent = 'Kelas ' + (siswa.kelas_nama || '-');
            document.getElementById('modalNIS').textContent = siswa.nis || '-';
            document.getElementById('modalGender').textContent = siswa.jenis_kelamin === 'L' ? 'Laki-laki' : (siswa.jenis_kelamin === 'P' ? 'Perempuan' : '-');
            document.getElementById('modalTahunAjaran').textContent = siswa.tahun_ajaran || '-';
            document.getElementById('modalKelas').textContent = siswa.kelas_nama || '-';
            document.getElementById('modalWaliKelas').textContent = siswa.wali_nama || '-';

            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeDetailModal() {
            const modal = document.getElementById('detailModal');
            modal.classList.add('hidden');
            document.body.style.overflow = '';
        }

        // Close on backdrop click
        document.getElementById('detailModal').addEventListener('click', function(e) {
            if (e.target === this) closeDetailModal();
        });

        // Close on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeDetailModal();
        });
    </script>
</div>
@endsection
