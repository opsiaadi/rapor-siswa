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
    <div class="flex items-center gap-2 shrink-0">
        <div class="w-10 h-10 rounded-xl flex items-center justify-center overflow-hidden">
            <img src="{{ asset('images/open-book.png') }}" class="w-full h-full object-contain">
        </div>
        <div>
            <h2 class="text-lg font-bold bg-gradient-to-r from-blue-600 to-violet-600 bg-clip-text text-transparent">EduReport</h2>
            <p class="text-xs text-gray-400">Sistem Rapor Digital</p>
        </div>
    </div>
</div>

<nav class="flex-1 p-4 space-y-1 overflow-y-auto min-h-0">
    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-3 mb-3">Menu Utama</p>

    <a href="{{ route('admin.dashboard', ['id' => $id ?? 1, 'nama' => $userName ?? 'Admin']) }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-blue-50 hover:pl-4 hover:text-blue-700' }}">
        <svg class="w-6 h-6 text-violet-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
            <path fill-rule="evenodd" d="M11.293 3.293a1 1 0 0 1 1.414 0l6 6 2 2a1 1 0 0 1-1.414 1.414L19 12.414V19a2 2 0 0 1-2 2h-3a1 1 0 0 1-1-1v-3h-2v3a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2v-6.586l-.293.293a1 1 0 0 1-1.414-1.414l2-2 6-6Z" clip-rule="evenodd"/>
        </svg>
        Dashboard
    </a>

    <a href="{{ route('admin.siswa.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.siswa.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-blue-50 hover:pl-4 hover:text-blue-700' }}">
        <svg class="w-6 h-6 text-blue-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
            <path fill-rule="evenodd" d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z" clip-rule="evenodd"/>
        </svg>
        Data Siswa
    </a>

    <a href="{{ route('admin.guru.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.guru.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-blue-50 hover:pl-4 hover:text-blue-700' }}">
        <svg class="w-6 h-6 text-purple-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
            <path d="M16 10c0-.55228-.4477-1-1-1h-3v2h3c.5523 0 1-.4477 1-1Z"/>
            <path d="M13 15v-2h2c1.6569 0 3-1.3431 3-3 0-1.65685-1.3431-3-3-3h-2.256c.1658-.46917.256-.97405.256-1.5 0-.51464-.0864-1.0091-.2454-1.46967C12.8331 4.01052 12.9153 4 13 4h7c.5523 0 1 .44772 1 1v9c0 .5523-.4477 1-1 1h-2.5l1.9231 4.6154c.2124.5098-.0287 1.0953-.5385 1.3077-.5098.2124-1.0953-.0287-1.3077-.5385L15.75 16l-1.827 4.3846c-.1825.438-.6403.6776-1.0889.6018.1075-.3089.1659-.6408.1659-.9864v-2.6002L14 15h-1ZM6 5.5C6 4.11929 7.11929 3 8.5 3S11 4.11929 11 5.5 9.88071 8 8.5 8 6 6.88071 6 5.5Z"/>
            <path d="M15 11h-4v9c0 .5523-.4477 1-1 1-.55228 0-1-.4477-1-1v-4H8v4c0 .5523-.44772 1-1 1s-1-.4477-1-1v-6.6973l-1.16797 1.752c-.30635.4595-.92722.5837-1.38675.2773-.45952-.3063-.5837-.9272-.27735-1.3867l2.99228-4.48843c.09402-.14507.2246-.26423.37869-.34445.11427-.05949.24148-.09755.3763-.10887.03364-.00289.06747-.00408.10134-.00355H15c.5523 0 1 .44772 1 1 0 .5523-.4477 1-1 1Z"/>
        </svg>
        Data Guru
    </a>

    <a href="{{ route('admin.mapel.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.mapel.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-blue-50 hover:pl-4 hover:text-blue-700' }}">
        <svg class="w-6 h-6 text-amber-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
            <path d="M9 6c0-1.65685 1.3431-3 3-3s3 1.34315 3 3-1.3431 3-3 3-3-1.34315-3-3Zm2 3.62992c-.1263-.04413-.25-.08799-.3721-.13131-1.33928-.47482-2.49256-.88372-4.77995-.8482C4.84875 8.66593 4 9.46413 4 10.5v7.2884c0 1.0878.91948 1.8747 1.92888 1.8616 1.283-.0168 2.04625.1322 2.79671.3587.29285.0883.57733.1863.90372.2987l.00249.0008c.11983.0413.24534.0845.379.1299.2989.1015.6242.2088.9892.3185V9.62992Zm2-.00374V20.7551c.5531-.1678 1.0379-.3374 1.4545-.4832.2956-.1034.5575-.1951.7846-.2653.7257-.2245 1.4655-.3734 2.7479-.3566.5019.0065.9806-.1791 1.3407-.4788.3618-.3011.6723-.781.6723-1.3828V10.5c0-.58114-.2923-1.05022-.6377-1.3503-.3441-.29904-.8047-.49168-1.2944-.49929-2.2667-.0352-3.386.36906-4.6847.83812-.1256.04539-.253.09138-.3832.13765Z"/>
        </svg>
        Mata Pelajaran
    </a>

    <a href="{{ route('admin.kelas.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.kelas.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-blue-50 hover:pl-4 hover:text-blue-700' }}">
        <svg class="w-6 h-6 text-emerald-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
            <path fill-rule="evenodd" d="M15 4c0-.55228.4477-1 1-1h4c.5523 0 1 .44772 1 1v3c0 .55228-.4477 1-1 1h-4v13H8V7.86853l-1.44532.96352c-.45952.30635-1.08039.18218-1.38675-.27735-.30635-.45953-.18217-1.0804.27735-1.38675l6.00002-4c.3359-.22393.7735-.22393 1.1094 0L15 4.79816V4Zm-5 8c0-.5523.4477-1 1-1h2c.5523 0 1 .4477 1 1s-.4477 1-1 1h-2c-.5523 0-1-.4477-1-1Zm1-4c-.5523 0-1 .44772-1 1s.4477 1 1 1h2c.5523 0 1-.44772 1-1s-.4477-1-1-1h-2Z" clip-rule="evenodd"/>
            <path d="M18 9.00011 17.9843 9h.0296L18 9.00011ZM6 10.5237l-2.27075.6386C3.29797 11.2836 3 11.677 3 12.125V20c0 .5523.44772 1 1 1h2V10.5237Zm14.2707.6386L18 10.5237V21h2c.5523 0 1-.4477 1-1v-7.875c0-.448-.298-.8414-.7293-.9627Z"/>
        </svg>
        Data Kelas
    </a>

    <div class="pt-4 mt-4 border-t border-gray-100">
        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-3 mb-3">Lainnya</p>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-red-600 hover:bg-red-50 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                Logout
            </button>
        </form>
    </div>
</nav>

<a href="{{ route('admin.profile.index') }}" class="block p-4 shrink-0 hover:bg-gray-50 transition-colors">
    @php $authUser = Auth::user(); @endphp
    <div class="flex items-center gap-1">
        <div class="w-16 h-16 rounded-full overflow-hidden ring-2 ring-white/30">
            <img src="{{ $authUser && $authUser->foto ? Storage::disk('public')->url($authUser->foto) : asset('images/users-avatar-svgrepo-com.svg') }}" class="h-full w-full object-cover">
        </div>
        <div class="flex-1 min-w-0">
            <p class="text-sm font-semibold text-gray-700 truncate">{{ $authUser->nama ?? ($userName ?? 'Admin') }}</p>
            <p class="text-xs text-gray-500 truncate">Admin TU</p>
        </div>
    </div>
</a>
