<svg class="absolute w-0 h-0">
    <defs>
        <linearGradient id="iconGradient" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" stop-color="#1e3a5f" />
            <stop offset="50%" stop-color="#1e4d3a" />
            <stop offset="100%" stop-color="#0f5132" />
        </linearGradient>
    </defs>
</svg>

<div class="p-5 border-b border-gray-100">
    <div class="flex items-center gap-3">
        <div class="w-10 h-10 rounded-xl flex items-center justify-center">
            <img src="{{ asset('images/open-book.png')}}" >
        </div>
        <div>
            <h2 class="text-lg font-bold text-blue-700">EduReport</h2>
            <p class="text-xs text-gray-400">Sistem Rapor Digital</p>
        </div>
    </div>
</div>

<nav class="flex-1 p-4 space-y-1 overflow-y-auto">
    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-3 mb-3">Menu Utama</p>

    <a href="{{ route('guru.dashboard', ['id' => $id ?? 1, 'namaGuru' => $namaGuru ?? 'Guru']) }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('guru.dashboard') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-blue-50 hover:pl-4 hover:text-blue-700' }}">
        <svg class="w-6 h-6 text-blue-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
            <path fill-rule="evenodd" d="M11.293 3.293a1 1 0 0 1 1.414 0l6 6 2 2a1 1 0 0 1-1.414 1.414L19 12.414V19a2 2 0 0 1-2 2h-3a1 1 0 0 1-1-1v-3h-2v3a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2v-6.586l-.293.293a1 1 0 0 1-1.414-1.414l2-2 6-6Z" clip-rule="evenodd"/>
        </svg>                    
        Beranda
    </a>

    <a href="{{ route('guru.nilai') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('guru.nilai') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-blue-50 hover:pl-4 hover:text-blue-700' }}">
        <svg class="w-6 h-6 text-blue-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
            <path d="M6 2c-1.10457 0-2 .89543-2 2v4c0 .55228.44772 1 1 1s1-.44772 1-1V4h12v7h-2c-.5523 0-1 .4477-1 1v2h-1c-.5523 0-1 .4477-1 1s.4477 1 1 1h5c.5523 0 1-.4477 1-1V3.85714C20 2.98529 19.3667 2 18.268 2H6Z"/>
            <path d="M6 11.5C6 9.567 7.567 8 9.5 8S13 9.567 13 11.5 11.433 15 9.5 15 6 13.433 6 11.5ZM4 20c0-2.2091 1.79086-4 4-4h3c2.2091 0 4 1.7909 4 4 0 1.1046-.8954 2-2 2H6c-1.10457 0-2-.8954-2-2Z"/>
        </svg>
        Input Nilai Siswa
    </a>

    <div class="pt-4 mt-4 border-t border-gray-100">
        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-3 mb-3">Lainnya</p>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-red-600 hover:bg-red-50 transition-all duration-200 hover:pl-4 active:scale-95">
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
            <img src="{{ asset('images/users-avatar-svgrepo-com.svg') }}" class="h-full w-full object-contain">
        </div>
        <div class="flex-1 min-w-0">
            <p class="text-sm font-semibold text-gray-700 truncate">{{ $namaGuru ?? 'Guru Mapel' }}</p>
            <p class="text-xs text-gray-500 truncate">Guru Pengajar</p>
        </div>
    </div>
</div>
