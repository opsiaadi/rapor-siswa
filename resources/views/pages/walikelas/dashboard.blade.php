<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Wali Kelas - {{ $nama ?? 'Wali Kelas' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@500&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50">

{{-- Sidebar Overlay for mobile --}}
<div id="sidebarOverlay" class="hidden fixed inset-0 bg-black/50 z-40 lg:hidden" onclick="toggleSidebar()"></div>

<div class="flex">
    @include('components.sidebar-walikelas', [
        'id' => $id,
        'nama' => $nama,
        'userName' => $nama ?? 'Wali Kelas'
    ])

    {{-- Main Content Wrapper --}}
    <div class="flex-1 lg:ml-64 flex flex-col min-h-screen">
        {{-- Navbar (di dalam content area) --}}
        @include('components.navbar-walikelas', [
            'pageTitle' => 'Dashboard',
            'breadcrumb' => 'Kelas ' . ($kelas['nama_kelas'] ?? ''),
            'userName' => $nama ?? 'Wali Kelas'
        ])
        
        {{-- Page Content --}}
        <main class="flex-1 p-4 lg:p-6">
            {{-- Welcome Banner --}}
            <div class="p-4 mb-6 text-white bg-gradient-to-br from-green-600 via-green-500 to-emerald-600 rounded-lg shadow-sm" role="alert">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-bold">Selamat Datang, {{ $nama ?? 'Wali Kelas' }}! 👋</h2>
                        <p class="text-sm text-white/80 mt-1">Kelola data siswa dan rapor kelas {{ $kelas['nama_kelas'] ?? '-' }} dengan mudah.</p>
                        <div class="flex items-center gap-2 mt-3 text-xs text-white/70">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <span>ID Wali Kelas: {{ $id ?? 'N/A' }} | Kelas: {{ $kelas['nama_kelas'] ?? '-' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Stats Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <div class="w-full p-4 bg-white rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Siswa</p>
                            <p class="text-2xl font-bold text-gray-900 mt-1">{{ count($siswa) }}</p>
                        </div>
                        <div class="p-3 bg-green-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354v4.354m0 0a4 4 0 1 1 0 4.353m0-4.353V4m0 0a4 4 0 0 1 0 4.353m0 0h.01M6 20h12a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-3.5m0 11.5v-7a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v7"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="w-full p-4 bg-white rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Laki-laki</p>
                            <p class="text-2xl font-bold text-gray-900 mt-1">{{ count(array_filter($siswa, fn($s) => $s['jenis_kelamin'] === 'L')) }}</p>
                        </div>
                        <div class="p-3 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="w-full p-4 bg-white rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Perempuan</p>
                            <p class="text-2xl font-bold text-gray-900 mt-1">{{ count(array_filter($siswa, fn($s) => $s['jenis_kelamin'] === 'P')) }}</p>
                        </div>
                        <div class="p-3 bg-pink-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="w-full p-4 bg-white rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Mata Pelajaran</p>
                            <p class="text-2xl font-bold text-gray-900 mt-1">{{ count($mapel) }}</p>
                        </div>
                        <div class="p-3 bg-purple-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tabel Siswa --}}
            <div class="bg-white rounded-lg shadow border border-gray-200 p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-bold">Daftar Siswa Kelas {{ $kelas['nama_kelas'] ?? '-' }}</h2>
                    <a href="{{ route('walikelas.rapot', ['id' => $id, 'nama' => $nama]) }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition-colors">Lihat Rapot</a>
                </div>
                
                @if(count($siswa) > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-100 border-b border-gray-200">
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">NIS</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Nama</th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-600">JK</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Tahun Ajaran</th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-600">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($siswa as $siswaItem)
                            <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-3 text-sm">{{ $siswaItem['nis'] }}</td>
                                <td class="px-4 py-3 text-sm font-medium">{{ $siswaItem['nama'] }}</td>
                                <td class="px-4 py-3 text-center text-sm">{{ $siswaItem['jenis_kelamin'] === 'L' ? 'L' : 'P' }}</td>
                                <td class="px-4 py-3 text-sm">{{ $siswaItem['tahun_ajaran'] }}</td>
                                <td class="px-4 py-3 text-center">
                                    <a href="{{ route('walikelas.rapot', ['id' => $siswaItem['id'], 'nama' => $siswaItem['nama']]) }}" class="text-green-600 hover:text-green-800 hover:underline text-sm font-medium">Lihat Rapot</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <p class="text-gray-500 text-center py-4">Belum ada siswa di kelas ini.</p>
                @endif
            </div>
        </main>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>