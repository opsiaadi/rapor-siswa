<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard Admin' }} - Sistem Pengolahan Rapor Siswa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/notifications.js'])
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
    <header class="lg:hidden bg-gradient-to-r from-emerald-700 via-emerald-800 to-green-900 text-white px-4 py-3 flex items-center gap-3 sticky top-0 z-50 shadow-lg">
        <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" data-drawer-backdrop="true" class="p-1.5 rounded-lg hover:bg-white/10 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
        <h1 class="text-lg font-bold">{{ $pageTitle ?? 'Dashboard' }}</h1>
    </header>

    <div class="flex">
        <aside id="logo-sidebar" data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" data-drawer-backdrop="true" data-drawer-placement="left" class="fixed lg:fixed inset-y-0 left-0 z-[60] w-64 min-h-screen transform -translate-x-full lg:translate-x-0 transition-transform duration-200 ease-in-out flex flex-col shadow-sm bg-white border-r border-gray-200">
            @include('layouts.partials.sidebar-admin')
        </aside>

        <div class="flex-1 lg:ml-64 flex flex-col min-h-screen">
            <header class="hidden lg:flex bg-gradient-to-r from-emerald-700 to-green-800 text-white border-b border-emerald-600 px-6 py-4 items-center justify-between sticky top-0 z-30 shadow-lg">
                <div>
                    <h1 class="text-xl font-bold text-white">{{ $pageTitle ?? 'Dashboard' }}</h1>
                    <p class="text-sm text-emerald-100/80">{{ $breadcrumb ?? 'Selamat datang di sistem pengolahan rapor siswa' }}</p>
                </div>
                <div class="flex items-center gap-4">
                    @php $authUser = Auth::user(); @endphp
                    <div class="relative" id="profile-dropdown">
                        <button type="button" onclick="toggleProfileDropdown()" class="flex items-center pl-4 border-l border-white/20 hover:bg-white/5 rounded-lg px-2 py-1 transition-colors">
                            <div class="relative w-14 h-14 rounded-full overflow-hidden">
                                <img src="{{ $authUser && $authUser->foto ? Storage::disk('public')->url($authUser->foto) : asset('images/users-avatar-svgrepo-com.svg') }}" class="h-full w-full object-cover">
                                <span id="profile-hist-badge" class="hidden absolute -top-1 -right-1 min-w-[18px] h-[18px] flex items-center justify-center px-1 text-[10px] font-bold text-white bg-red-500 rounded-full"></span>
                            </div>
                        </button>
                        <div id="profile-panel" class="hidden absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-2xl border border-gray-200 z-50 overflow-hidden">
                            <div class="px-4 py-3 border-b border-gray-100">
                                <h3 class="text-sm font-bold text-gray-800">Profil & Histori</h3>
                            </div>
                            <div class="border-t border-gray-100 py-2">
                                <a href="{{ route('admin.profile.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    Lihat Profil
                                </a>
                            </div>
                            <div class="border-t border-gray-100 py-2">
                                <button type="button" onclick="toggleHistPanel()" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                    <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    Histori
                                </button>
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
                        <div id="hist-panel" class="hidden absolute right-full top-0 mr-2 w-80 bg-white rounded-xl shadow-2xl border border-gray-200 z-50 overflow-hidden max-h-[80vh] flex flex-col">
                            <div class="flex items-center justify-between px-4 py-3 border-b border-gray-100 bg-gray-50">
                                <h3 class="text-sm font-bold text-gray-800">Histori</h3>
                                <div class="flex items-center gap-2">
                                    <button type="button" onclick="markAllRead()" class="text-xs text-blue-600 hover:text-blue-800 font-medium">Tandai semua dibaca</button>
                                    <button type="button" onclick="clearAllNotifications()" class="text-xs text-red-500 hover:text-red-700 font-medium">Hapus</button>
                                    <button type="button" onclick="toggleHistPanel()" class="ml-1 text-gray-400 hover:text-gray-600">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                    </button>
                                </div>
                            </div>
                            <div id="hist-list" class="flex-1 overflow-y-auto divide-y divide-gray-100">
                                <p class="px-4 py-6 text-center text-sm text-gray-400">Memuat histori...</p>
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
                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        <span>&copy; 2025 EduReport — Sistem Pengolahan Rapor Siswa</span>
                    </div>
                    <span class="text-xs"></span>
                </div>
            </footer>
        </div>
    </div>
    <script>
        window.__notif = {
            url: '{{ route("admin.notifications") }}',
            readUrl: '{{ url("admin/notifications") }}',
            csrf: '{{ csrf_token() }}',
            flashSuccess: @json(session('success')),
            flashError: @json(session('error')),
        };
        function toggleProfileDropdown() {
            const panel = document.getElementById('profile-panel');
            const histPanel = document.getElementById('hist-panel');
            panel.classList.toggle('hidden');
            if (!panel.classList.contains('hidden')) {
                histPanel.classList.add('hidden');
            }
        }
        function toggleHistPanel() {
            const histPanel = document.getElementById('hist-panel');
            histPanel.classList.toggle('hidden');
        }
        document.addEventListener('click', function(e) {
            const dropdown = document.getElementById('profile-dropdown');
            if (dropdown && !dropdown.contains(e.target)) {
                document.getElementById('profile-panel').classList.add('hidden');
                document.getElementById('hist-panel').classList.add('hidden');
            }
        });
    </script>
    @stack('scripts')
</body>
</html>