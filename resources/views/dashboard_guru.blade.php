<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard Guru' }} - Sistem Pengolahan Rapor Siswa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }

        function toggleTheme() {
            const html = document.documentElement;
            if (html.classList.contains('dark')) {
                html.classList.remove('dark');
                localStorage.theme = 'light';
            } else {
                html.classList.add('dark');
                localStorage.theme = 'dark';
            }
        }

        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('-translate-x-full');
            document.getElementById('sidebarOverlay').classList.toggle('hidden');
        }
    </script>
    <style>
        .icon-gradient {
            stroke: url(#iconGradient);
        }
        .icon-gradient-filled {
            fill: url(#iconGradient);
        }
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900 min-h-screen font-sans transition-colors duration-300">
    <!-- Mobile Header -->
    <header class="lg:hidden bg-gradient-to-r from-blue-700 via-blue-800 to-indigo-900 dark:from-blue-900 dark:via-indigo-900 dark:to-gray-900 text-white px-4 py-3 flex items-center justify-between sticky top-0 z-60 shadow-lg">
        <button onclick="toggleSidebar()" class="p-1.5 rounded-lg hover:bg-white/10 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
        <div class="flex items-center gap-2">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
            </svg>
            <h1 class="text-lg font-bold">EduReport</h1>
        </div>
        <button onclick="toggleTheme()" class="p-1.5 rounded-lg hover:bg-white/10 transition-colors">
            <svg class="w-5 h-5 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
            </svg>
            <svg class="w-5 h-5 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
            </svg>
        </button>
    </header>

    <div class="flex">
        <!-- Sidebar -->
         <aside id="sidebar" class="fixed lg:fixed inset-y-0 left-0 z-50 w-64 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 min-h-screen transform -translate-x-full lg:translate-x-0 transition-transform duration-200 ease-in-out flex flex-col shadow-sm">
            <!-- SVG Gradient Definition -->
            <svg class="absolute w-0 h-0">
                <defs>
                    <linearGradient id="iconGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" stop-color="#1e3a5f" />
                        <stop offset="50%" stop-color="#1e4d3a" />
                        <stop offset="100%" stop-color="#0f5132" />
                    </linearGradient>
                </defs>
            </svg>

            <!-- Logo -->
            <div class="p-5 border-b border-gray-100 dark:border-gray-700">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 via-indigo-500 to-violet-500 rounded-xl flex items-center justify-center shadow-lg shadow-blue-200 dark:shadow-blue-900/30">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold bg-gradient-to-r from-blue-600 to-violet-600 dark:from-blue-400 dark:to-violet-400 bg-clip-text text-transparent">EduReport</h2>
                        <p class="text-xs text-gray-400 dark:text-gray-500">Sistem Rapor Digital</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
                <p class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider px-3 mb-3">Menu Utama</p>

                <a href="{{ route('guru.dashboard', ['id' => $id, 'namaGuru' => $namaGuru]) }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium bg-blue-50 dark:bg-blue-900/20 text-blue-700 dark:text-blue-400 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" class="icon icon-tabler icons-tabler-outline icon-tabler-home flex-shrink-0 icon-gradient" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M5 12l-2 0l9 -9l9 9l-2 0" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                    BERANDA
                </a>

                <div class="pt-4 mt-4 border-t border-gray-100 dark:border-gray-700">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </nav>

            <!-- User Profile -->
            <div class="p-4 border-t border-gray-100 dark:border-gray-700">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-violet-500 flex items-center justify-center text-white font-semibold text-sm shadow-md">
                        {{ strtoupper(substr($namaGuru ?? 'G', 0, 1)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-gray-700 dark:text-gray-200 truncate">{{ $namaGuru ?? 'Guru Mapel' }}</p>
                        <p class="text-xs text-gray-400 dark:text-gray-500 truncate">Guru Pengajar</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Sidebar Overlay (Mobile) -->
        <div id="sidebarOverlay" class="hidden fixed inset-0 bg-black/50 z-40 lg:hidden" onclick="toggleSidebar()"></div>

        <!-- Main Content -->
        <div class="flex-1 lg:ml-64 flex flex-col min-h-screen">
            <!-- Desktop Navbar -->
            <header class="hidden lg:flex bg-gradient-to-r from-blue-700 to-indigo-800 dark:from-blue-900 dark:to-indigo-950 text-white border-b border-blue-600 dark:border-blue-800 px-6 py-4 items-center justify-between sticky top-0 z-30 shadow-lg">
                <div>
                    <h1 class="text-xl font-bold text-white">Input Nilai Siswa</h1>
                </div>
                <div class="flex items-center gap-4">
                    <!-- Theme Toggle -->
                    <button onclick="toggleTheme()" class="p-2 rounded-lg text-blue-100 hover:text-white hover:bg-white/10 transition-colors" title="Toggle Dark/Light Mode">
                        <svg class="w-5 h-5 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                        </svg>
                        <svg class="w-5 h-5 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </button>


                    <!-- User Avatar -->
                    <div class="flex items-center gap-3 pl-4 border-l border-white/20">
                        <div class="w-9 h-9 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center text-white font-semibold text-sm shadow-md ring-2 ring-white/30">
                            {{ strtoupper(substr($namaGuru ?? 'G', 0, 1)) }}
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-white">{{ $namaGuru ?? 'Guru Mapel' }}</p>
                            <p class="text-xs text-blue-100/70">Guru Pengajar</p>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-4 lg:p-6">
                <!-- Form Filter -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6 mb-6">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Pilih Data</h2>
                    <form method="POST" action="{{ route('guru.nilai') }}" class="flex flex-wrap gap-4 items-end">
                        @csrf
                        <input type="hidden" name="guru_id" value="{{ $id }}">
                        <input type="hidden" name="guru_nama" value="{{ $namaGuru }}">
                        <div class="flex-1 min-w-[200px]">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Kelas</label>
                            <select name="kelas" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Pilih Kelas</option>
                                @foreach($kelasList as $kelas)
                                    <option value="{{ (string)$kelas->id }}" {{ (isset($filter['kelasId']) && (string)$filter['kelasId'] === (string)$kelas->id) ? 'selected' : '' }}>
                                        {{ $kelas->nama_kelas }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex-1 min-w-[200px]">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Semester</label>
                            <select name="semester" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Pilih Semester</option>
                                <option value="1" {{ ($filter['semester'] ?? '') == '1' ? 'selected' : '' }}>Semester 1</option>
                                <option value="2" {{ ($filter['semester'] ?? '') == '2' ? 'selected' : '' }}>Semester 2</option>
                            </select>
                        </div>
                        <div class="flex-1 min-w-[200px]">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Mata Pelajaran</label>
                            <select name="mapel" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Pilih Mapel</option>
                                @foreach($mapelList as $mapel)
                                    <option value="{{ $mapel->id }}" {{ ($filter['mapelId'] ?? '') == $mapel->id ? 'selected' : '' }}>
                                        {{ $mapel->nama_mapel }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                                TAMPILKAN
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Tabel Siswa -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="p-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Daftar Nilai Siswa</h2>
                        <div class="flex gap-2">
                            <button type="button" id="btn-edit" class="px-3 py-1.5 bg-amber-500 hover:bg-amber-600 text-white text-sm font-medium rounded-lg transition-colors">
                                EDIT
                            </button>
                            <button type="button" id="btn-simpan" class="px-3 py-1.5 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition-colors disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                                SIMPAN
                            </button>
                            <button type="button" id="btn-kirim" class="px-3 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-colors disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                                KIRIM
                            </button>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-300">
                                <tr>
                                    <th class="px-6 py-3">No</th>
                                    <th class="px-6 py-3">Nama Siswa</th>
                                    <th class="px-6 py-3 text-center">NIS</th>
                                    <th class="px-6 py-3 text-center">Kelas</th>
                                    <th class="px-6 py-3 text-center">Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($siswaList ?? [] as $siswa)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4">{{ $siswa['nama'] }}</td>
                                    <td class="px-6 py-4 text-center">{{ $siswa['nis'] }}</td>
                                    <td class="px-6 py-4 text-center">{{ $siswa['kelas_nama'] }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <input type="number" name="nilai[{{ $siswa['id'] }}]" class="w-20 px-2 py-1 border border-gray-300 dark:border-gray-600 rounded text-center bg-gray-100 dark:bg-gray-700" disabled>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                        {{ isset($filter['kelasId']) && $filter['kelasId'] ? 'Tidak ada siswa di kelas ini' : 'Pilih kelas untuk menampilkan siswa' }}
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <script>
                    const btnEdit = document.getElementById('btn-edit');
                    const btnSimpan = document.getElementById('btn-simpan');
                    const btnKirim = document.getElementById('btn-kirim');

                    function getNilaiInputs() {
                        return document.querySelectorAll('input[type="number"][name^="nilai"]');
                    }

                    let isEditing = false;

                    btnEdit.addEventListener('click', function() {
                        isEditing = true;
                        getNilaiInputs().forEach(input => {
                            input.disabled = false;
                            input.classList.remove('bg-gray-100', 'dark:bg-gray-700');
                            input.classList.add('bg-white', 'dark:bg-gray-600');
                        });
                        btnEdit.disabled = true;
                        btnSimpan.disabled = false;
                    });

                    btnSimpan.addEventListener('click', function() {
                        getNilaiInputs().forEach(input => {
                            input.disabled = true;
                            input.classList.add('bg-gray-100', 'dark:bg-gray-700');
                            input.classList.remove('bg-white', 'dark:bg-gray-600');
                        });
                        btnEdit.disabled = false;
                        btnSimpan.disabled = true;
                        btnKirim.disabled = false;
                    });

                    btnKirim.addEventListener('click', function() {
                        btnEdit.disabled = true;
                        btnSimpan.disabled = true;
                        btnKirim.disabled = true;
                        getNilaiInputs().forEach(input => input.disabled = true);
                        alert('Nilai berhasil dikirim!');
                    });
                </script>
            </main>

            <!-- Footer -->
            <footer class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-2 text-sm text-gray-500 dark:text-gray-400">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        <span>&copy; 2025 EduReport — Sistem Pengolahan Rapor Siswa</span>
                    </div>
                    <span class="text-xs">v1.0.0</span>
                </div>
            </footer>
        </div>
    </div>
</body>
</html>