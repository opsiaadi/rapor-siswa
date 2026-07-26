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
    <div class="flex items-center gap-3 shrink-0">
        <div class="w-10 h-10 rounded-xl flex items-center justify-center overflow-hidden">
            <img src="{{ asset('images/open-book.png')}}" class="w-full h-full object-contain">
        </div>
        <div>
            <h2 class="text-lg font-bold text-gray-900">EduReport</h2>
            <p class="text-xs text-gray-500">Area Wali Kelas</p>
        </div>
    </div>
</div>

<nav class="flex-1 p-4 space-y-1 overflow-y-auto min-h-0">
    <p class="text-xs font-semibold uppercase tracking-wider px-3 mb-3 text-gray-400">Menu Wali Kelas</p>

    <a href="{{ route('walikelas.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 hover:pl-4" style="{{ request()->routeIs('walikelas.dashboard') ? 'background-color: rgba(34, 211, 238, 0.12); color: #111827;' : 'color: #4b5563;' }}">
        <svg class="w-6 h-6 text-cyan-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
            <path fill-rule="evenodd" d="M11.293 3.293a1 1 0 0 1 1.414 0l6 6 2 2a1 1 0 0 1-1.414 1.414L19 12.414V19a2 2 0 0 1-2 2h-3a1 1 0 0 1-1-1v-3h-2v3a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2v-6.586l-.293.293a1 1 0 0 1-1.414-1.414l2-2 6-6Z" clip-rule="evenodd"/>
        </svg>
        Dashboard
    </a>

    <a href="{{ route('walikelas.siswa') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 hover:pl-4" style="{{ request()->routeIs('walikelas.siswa') ? 'background-color: rgba(34, 211, 238, 0.12); color: #111827;' : 'color: #4b5563;' }}">
        <svg class="w-6 h-6 text-cyan-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
            <path fill-rule="evenodd" d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z" clip-rule="evenodd"/>
        </svg> 
        Data Siswa
    </a>

    <a href="{{ route('walikelas.finalisasi') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 hover:pl-4" style="{{ request()->routeIs('walikelas.finalisasi') ? 'background-color: rgba(34, 211, 238, 0.12); color: #111827;' : 'color: #4b5563;' }}">
        <svg class="w-6 h-6 text-cyan-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
        </svg>
    Finalisasi Rapor
    </a>

    </nav>

<div class="p-4 shrink-0">
    <div class="flex items-center gap-1">
        <div class="w-16 h-16 rounded-full bg-gradient-to-br flex items-center justify-center text-white font-semibold text-sm ring-2 ring-white/30 overflow-hidden">
            <img src="{{ asset('images/users-avatar-svgrepo-com.svg') }}" class="w-full h-full object-contain">
        </div>
        <div class="flex-1 min-w-0">
            <p class="text-sm font-semibold text-gray-900 truncate">{{ $namaGuru ?? 'Wali Kelas' }}</p>
            <p class="text-xs text-gray-500 truncate">Wali Kelas</p>
        </div>
    </div>
</div>
