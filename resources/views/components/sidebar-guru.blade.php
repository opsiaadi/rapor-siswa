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
