<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard Wali Kelas' }} - Sistem Pengolahan Rapor Siswa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .icon-gradient {
            stroke: url(#iconGradient);
        }
        .icon-gradient-filled {
            fill: url(#iconGradient);
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen font-sans transition-colors duration-300">
    <header class="lg:hidden text-white px-4 py-3 flex items-center justify-between sticky top-0 z-50 shadow-lg" style="background-color: #155e75;">
        <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" data-drawer-backdrop="true" class="p-1.5 rounded-lg hover:bg-cyan-400/20 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
        <h1 class="text-lg font-bold">{{ $pageTitle ?? 'Dashboard Wali Kelas' }}</h1>
        <button onclick="toggleTheme()" class="p-1.5 rounded-lg hover:bg-cyan-400/20 transition-colors">
            <svg class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
            </svg>
            <svg class="w-5 h-5 block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
            </svg>
        </button>
    </header>

    <div class="flex">
        <aside id="logo-sidebar" data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" data-drawer-backdrop="true" data-drawer-placement="left" class="fixed lg:fixed inset-y-0 left-0 z-[60] w-64 min-h-screen transform -translate-x-full lg:translate-x-0 transition-transform duration-200 ease-in-out flex flex-col shadow-sm" style="background-color: #ffffff; border-right: 1px solid #e5e7eb;">
            @include('layouts.partials.sidebar-walikelas')
        </aside>

        <div class="flex-1 lg:ml-64 flex flex-col min-h-screen">
            <header class="hidden lg:flex text-white border-b px-6 py-4 items-center justify-between sticky top-0 z-30 shadow-lg" style="background-color: #155e75; border-color: #164e63;">
                <div>
                    <h1 class="text-xl font-bold text-white">{{ $pageTitle ?? 'Dashboard Wali Kelas' }}</h1>
                    <p class="text-sm" style="color: rgba(165, 243, 252, 0.9);">{{ $breadcrumb ?? 'Kelola finalisasi rapor dan data kelas perwalian.' }}</p>
                </div>
<div class="flex items-center gap-4">
                         <div class="relative" id="profile-dropdown">
                             <button type="button" onclick="toggleProfileDropdown()" class="flex items-center pl-4 border-l border-white/20 hover:bg-white/10 rounded-lg px-2 py-1 transition-colors">
                                 <div class="relative w-14 h-14 rounded-full overflow-hidden">
                                     <img src="{{ asset('images/users-avatar-svgrepo-com.svg') }}" class="h-full w-full object-cover">
                                 </div>
                             </button>
                             <div id="profile-panel" class="hidden absolute right-0 mt-2 w-72 bg-white rounded-xl shadow-xl border border-gray-200 z-50 overflow-hidden">
                                 <div class="px-4 py-3 border-b border-gray-100">
                                     <div class="flex items-center gap-3">
                                         <div class="w-10 h-10 rounded-full overflow-hidden">
                                             <img src="{{ asset('images/users-avatar-svgrepo-com.svg') }}" class="h-full w-full object-cover">
                                         </div>
                                         <div>
                                             <p class="text-sm font-semibold text-gray-800">{{ $namaGuru ?? 'Wali Kelas' }}</p>
                                             <p class="text-xs text-gray-500">Wali Kelas</p>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="py-2">
                                     <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                         <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                         Profil
                                     </a>
                                 </div>
                                 <div class="border-t border-gray-100 py-2">
                                     <form method="POST" action="{{ route('logout') }}">
                                         @csrf
                                         <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                             <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                             Logout
                                         </button>
                                     </form>
                                 </div>
                             </div>
                         </div>
                     </div>
            </header>

            <main class="flex-1 p-4 lg:p-6">
                @yield('content')
            </main>

            <footer class="px-6 py-4 border-t border-gray-200 bg-white">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-2 text-sm text-gray-500">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        <span>&copy; 2025 EduReport — Modul Wali Kelas</span>
                    </div>
                    <span class="text-xs"></span>
                </div>
            </footer>
        </div>
    </div>
    <div id="toast-container" class="fixed top-4 right-4 z-[100] flex flex-col gap-2"></div>

<script>
    function toggleProfileDropdown() {
        const panel = document.getElementById('profile-panel');
        panel.classList.toggle('hidden');
    }
    document.addEventListener('click', function(e) {
        const dropdown = document.getElementById('profile-dropdown');
        if (dropdown && !dropdown.contains(e.target)) {
            const panel = document.getElementById('profile-panel');
            if (panel) panel.classList.add('hidden');
        }
    });
    </script>
    @stack('scripts')
</body>
</html>