<!-- Desktop Navbar -->
<header class="hidden lg:flex bg-gradient-to-r from-emerald-700 to-green-800 dark:from-emerald-900 dark:to-green-950 text-white border-b border-emerald-600 dark:border-emerald-800 px-6 py-4 items-center justify-between sticky top-0 z-30 shadow-lg">
    <!-- Logo & Title -->
    <div class="flex items-center gap-3">
        <div class="w-10 h-10 bg-white/20 backdrop-blur-sm flex items-center justify-center rounded-xl">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
            </svg>
        </div>
        <div>
            <h1 class="text-xl font-bold text-white">EduReport</h1>
            <p class="text-sm text-emerald-100/80">{{ $pageTitle ?? 'Dashboard' }} - {{ $breadcrumb ?? 'Selamat datang di sistem pengolahan rapor siswa' }}</p>
        </div>
    </div>
    <div class="flex items-center gap-4">
        <!-- Theme Toggle (Left) -->
        <button onclick="toggleTheme()" class="p-2 rounded-lg text-emerald-100 hover:text-white hover:bg-white/10 transition-colors relative" title="Toggle Dark/Light Mode">
            <!-- Sun icon (light mode) -->
            <svg class="w-5 h-5 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
            </svg>
            <!-- Moon icon (dark mode) -->
            <svg class="w-5 h-5 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
            </svg>
        </button>

        <!-- Notifications -->
        <button class="p-1 rounded-lg text-emerald-100 hover:text-white hover:bg-white/10 transition-colors relative" title="Notifications">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
            </svg>
            <!-- Notification badge -->
            <span class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-xs font-bold rounded-full flex items-center justify-center border-2 border-emerald-700">3</span>
        </button>

        <!-- User Avatar -->
        <div class="flex items-center gap-3 pl-4 border-l border-white/20">
            <div class="w-9 h-9 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center text-white font-semibold text-sm shadow-md ring-2 ring-white/30">
                {{ strtoupper(substr($userName ?? 'A', 0, 1)) }}
            </div>
            <div>
                <p class="text-sm font-semibold text-white">{{ $userName ?? 'Admin' }}</p>
                <p class="text-xs text-emerald-100/70">Admin TU</p>
            </div>
        </div>
    </div>
</header>
