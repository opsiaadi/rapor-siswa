<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard Wali Kelas' }} - Sistem Pengolahan Rapor Siswa</title>
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
    <header class="lg:hidden text-white px-4 py-3 flex items-center justify-between sticky top-0 z-50 shadow-lg" style="background-color: #155e75;">
        <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" data-drawer-backdrop="true" class="p-1.5 rounded-lg hover:bg-cyan-400/20 transition-colors">
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
        <button onclick="toggleTheme()" class="p-1.5 rounded-lg hover:bg-cyan-400/20 transition-colors">
            <svg class="w-5 h-5 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
            </svg>
            <svg class="w-5 h-5 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
            </svg>
        </button>
    </header>

    <div class="flex">
        <aside id="logo-sidebar" data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" data-drawer-backdrop="true" data-drawer-placement="left" class="fixed lg:fixed inset-y-0 left-0 z-40 w-64 min-h-screen transform -translate-x-full lg:translate-x-0 transition-transform duration-200 ease-in-out flex flex-col shadow-sm" style="background-color: #ffffff; border-right: 1px solid #e5e7eb;">
            <svg class="absolute w-0 h-0">
                <defs>
                    <linearGradient id="iconGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" stop-color="#06b6d4" />
                        <stop offset="50%" stop-color="#0891b2" />
                        <stop offset="100%" stop-color="#155e75" />
                    </linearGradient>
                </defs>
            </svg>

            <div class="p-5 border-b" style="border-color: #e5e7eb;">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center">
                        <img src="{{ asset('images/open-book.png')}}">
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-gray-900">EduReport</h2>
                        <p class="text-xs text-gray-500">Area Wali Kelas</p>
                    </div>
                </div>
            </div>

            <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
                <p class="text-xs font-semibold uppercase tracking-wider px-3 mb-3 text-gray-400">Menu Wali Kelas</p>

                <a href="{{ route('walikelas.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors" style="{{ request()->routeIs('walikelas.dashboard') ? 'background-color: rgba(34, 211, 238, 0.12); color: #111827;' : 'color: #4b5563;' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" class="icon icon-tabler icons-tabler-outline icon-tabler-home flex-shrink-0 icon-gradient" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M5 12l-2 0l9 -9l9 9l-2 0" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                    Dashboard
                </a>

                <a href="{{ route('walikelas.siswa') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors" style="{{ request()->routeIs('walikelas.siswa') ? 'background-color: rgba(34, 211, 238, 0.12); color: #111827;' : 'color: #4b5563;' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" class="icon icon-tabler icons-tabler-outline icon-tabler-users flex-shrink-0 icon-gradient" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg>
                    Data Siswa
                </a>

                <a href="{{ route('walikelas.finalisasi') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors" style="{{ request()->routeIs('walikelas.finalisasi') ? 'background-color: rgba(34, 211, 238, 0.12); color: #111827;' : 'color: #4b5563;' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" class="icon icon-tabler icons-tabler-outline icon-tabler-checkbox flex-shrink-0 icon-gradient" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 11l3 3l8-8"/><path d="M20 12v6a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h9"/></svg>
                    Finalisasi Rapor
                </a>

                <div class="pt-4 mt-4 border-t" style="border-color: #e5e7eb;">
                    <p class="text-xs font-semibold uppercase tracking-wider px-3 mb-3 text-gray-400">Lainnya</p>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-semibold transition-colors" style="color: #dc2626;">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </nav>

            <div class="p-4">
                <div class="flex items-center gap-1">
                    <div class="w-16 h-16 rounded-full bg-gradient-to-br flex items-center justify-center text-white font-semibold text-sm ring-2 ring-white/30">
                        <img src="{{ asset('images/User2.png') }}" class="h-full w-full object-contain">
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-gray-900 dark:text-gray-200 truncate">{{ $namaGuru ?? 'Wali Kelas' }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 truncate">Wali Kelas</p>
                    </div>
                </div>
            </div>
        </aside>

        <div class="flex-1 lg:ml-64 flex flex-col min-h-screen">
            <header class="hidden lg:flex text-white border-b px-6 py-4 items-center justify-between sticky top-0 z-30 shadow-lg" style="background-color: #155e75; border-color: #164e63;">
                <div>
                    <h1 class="text-xl font-bold text-white">{{ $pageTitle ?? 'Dashboard Wali Kelas' }}</h1>
                    <p class="text-sm" style="color: rgba(165, 243, 252, 0.9);">{{ $breadcrumb ?? 'Kelola finalisasi rapor dan data kelas perwalian.' }}</p>
                </div>
                <div class="flex items-center gap-4">
                    <button onclick="toggleTheme()" class="p-2 rounded-lg hover:text-white transition-colors relative" style="color: rgba(165, 243, 252, 0.9);" title="Toggle Dark/Light Mode">
                        <svg class="w-5 h-5 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        <svg class="w-5 h-5 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                        </svg>
                    </button>

                    <button class="p-2 rounded-lg hover:text-white transition-colors relative" style="color: rgba(165, 243, 252, 0.9);">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        <span class="absolute top-1.5 right-1.5 w-2 h-2 rounded-full" style="background-color: #22d3ee;"></span>
                    </button>

                    <div class="flex items-center gap-1 pl-4 border-l border-white/20">
                        <div class="w-14 h-14 rounded-full overflow-hidden">
                            <img src="{{ asset('images/User2.png') }}" class="h-full w-full object-cover"> 
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-white">{{ $namaGuru ?? 'Wali Kelas' }}</p>
                            <p class="text-xs text-cyan-200">Wali Kelas</p>
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 p-4 lg:p-6">
                @yield('content')
            </main>

            <footer class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-2 text-sm text-gray-500 dark:text-gray-400">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        <span>&copy; 2025 EduReport — Modul Wali Kelas</span>
                    </div>
                    <span class="text-xs">v1.0.0</span>
                </div>
            </footer>
        </div>
    </div>
</body>
</html>