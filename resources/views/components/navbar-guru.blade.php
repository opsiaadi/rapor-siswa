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
