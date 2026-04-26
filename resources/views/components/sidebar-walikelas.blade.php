<!-- Sidebar -->
<aside id="sidebar" class="fixed lg:fixed inset-y-0 left-0 z-50 w-64 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 min-h-screen transform -translate-x-full lg:translate-x-0 transition-transform duration-200 ease-in-out flex flex-col shadow-sm">
    <!-- SVG Gradient Definition -->
    <svg class="absolute w-0 h-0">
        <defs>
            <linearGradient id="iconGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" stop-color="#166534" />
                <stop offset="50%" stop-color="#15803d" />
                <stop offset="100%" stop-color="#22c55e" />
            </linearGradient>
        </defs>
    </svg>

    <!-- Logo -->
    <div class="p-5 border-b border-gray-100 dark:border-gray-700">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-gradient-to-br from-green-500 via-green-600 to-green-700 rounded-xl flex items-center justify-center shadow-lg shadow-green-200 dark:shadow-green-900/30">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <div>
                <h2 class="text-lg font-bold bg-gradient-to-r from-green-600 to-green-700 dark:from-green-400 dark:to-green-500 bg-clip-text text-transparent">EduReport</h2>
                <p class="text-xs text-gray-400 dark:text-gray-500">Sistem Rapor Digital</p>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
        <p class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider px-3 mb-3">Menu Utama</p>

        <a href="{{ route('walikelas.dashboard', ['id' => $id ?? 1, 'nama' => $nama ?? 'Wali Kelas']) }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->is('walikelas/dashboard*') ? 'bg-green-50 dark:bg-green-900/20 text-green-700 dark:text-green-400' : 'text-gray-600 dark:text-gray-400 hover:bg-green-50 dark:hover:bg-green-900/20 hover:text-green-700 dark:hover:text-green-400' }} transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="url(#iconGradient)" class="flex-shrink-0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M5 12l-2 0l9 -9l9 9l-2 0" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
            Dashboard
        </a>

        <a href="{{ route('walikelas.siswa', ['id' => $id ?? 1, 'nama' => $nama ?? 'Wali Kelas']) }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->is('walikelas/siswa*') ? 'bg-green-50 dark:bg-green-900/20 text-green-700 dark:text-green-400' : 'text-gray-600 dark:text-gray-400 hover:bg-green-50 dark:hover:bg-green-900/20 hover:text-green-700 dark:hover:text-green-400' }} transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="url(#iconGradient)" class="flex-shrink-0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg>
            Data Siswa Kelas
        </a>

        <a href="{{ route('walikelas.nilai', ['id' => $id ?? 1, 'nama' => $nama ?? 'Wali Kelas']) }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->is('walikelas/nilai*') ? 'bg-green-50 dark:bg-green-900/20 text-green-700 dark:text-green-400' : 'text-gray-600 dark:text-gray-400 hover:bg-green-50 dark:hover:bg-green-900/20 hover:text-green-700 dark:hover:text-green-400' }} transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="url(#iconGradient)" class="flex-shrink-0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M9 5H7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2V7a2 2 0 0 0 -2 -2h-2" /><path d="M9 5a2 2 0 0 0 2 2h2a2 2 0 0 0 2 -2a2 2 0 0 0 -2 2h2" /><path d="M9 14l2 2l4 -4" /></svg>
            Input Nilai
        </a>

        <a href="{{ route('walikelas.rapot', ['id' => $id ?? 1, 'nama' => $nama ?? 'Wali Kelas']) }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->is('walikelas/rapot*') ? 'bg-green-50 dark:bg-green-900/20 text-green-700 dark:text-green-400' : 'text-gray-600 dark:text-gray-400 hover:bg-green-50 dark:hover:bg-green-900/20 hover:text-green-700 dark:hover:text-green-400' }} transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="url(#iconGradient)" class="flex-shrink-0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M14 2H6a2 2 0 0 0 -2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2V8z" /><path d="M14 2v6h6" /><path d="M16 13H8" /><path d="M16 17H8" /><path d="M10 9H8" /></svg>
            Lihat Rapot
        </a>

        <a href="{{ route('rapor.finalisasi', ['id' => $id ?? 1, 'nama' => $nama ?? 'Wali Kelas']) }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->is('rapor/finalisasi*') ? 'bg-green-50 dark:bg-green-900/20 text-green-700 dark:text-green-400' : 'text-gray-600 dark:text-gray-400 hover:bg-green-50 dark:hover:bg-green-900/20 hover:text-green-700 dark:hover:text-green-400' }} transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="url(#iconGradient)" class="flex-shrink-0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M9 11l3 3L22 4" /><path d="M21 12v7a2 2 0 0 1 -2 2H5a2 2 0 0 1 -2 -2V5a2 2 0 0 1 2 -2h11" /></svg>
            Finalisasi Rapor
        </a>

        <div class="pt-4 mt-4 border-t border-gray-100 dark:border-gray-700">
            <p class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider px-3 mb-3">Lainnya</p>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 w-full transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="url(#iconGradient)" class="flex-shrink-0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M9 21H5a2 2 0 0 1 -2 -2V5a2 2 0 0 1 2 -2h4" /><path d="M16 17l5 -5l-5 -5" /><path d="M21 12H9" /></svg>
                    Logout
                </button>
            </form>
        </div>
    </nav>

    <!-- User Profile -->
    <div class="p-4 border-t border-gray-100 dark:border-gray-700">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-green-500 to-green-600 flex items-center justify-center text-white font-semibold text-sm shadow-md">
                {{ strtoupper(substr($userName ?? $nama ?? 'W', 0, 1)) }}
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-semibold text-gray-700 dark:text-gray-200 truncate">{{ $userName ?? $nama ?? 'Wali Kelas' }}</p>
                <p class="text-xs text-gray-400 dark:text-gray-500 truncate">Wali Kelas</p>
            </div>
        </div>
    </div>
</aside>