<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SiRapor — Sistem Pengolahan Rapor Siswa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@600;700;800&family=Inter:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }
        h1,h2,h3,h4 { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-white text-gray-800 antialiased">

<!-- ==================== NAVBAR ==================== -->
<nav class="bg-white border-b border-gray-100 fixed w-full z-50 top-0">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <a href="/homepage" class="flex items-center space-x-3">
                <img src="{{ asset('images/open-book.png') }}" class="h-9 w-auto" alt="SiRapor">
                <span class="text-xl font-bold text-gray-900">SiRapor</span>
            </a>

            <div class="hidden md:flex md:items-center md:space-x-8">
                <a href="#hero" class="text-sm font-medium text-blue-600">Beranda</a>
                <a href="#fitur" class="text-sm font-medium text-gray-600 hover:text-blue-600 transition-colors">Fitur</a>
                <a href="#tentang" class="text-sm font-medium text-gray-600 hover:text-blue-600 transition-colors">Tentang</a>
                <a href="#kontak" class="text-sm font-medium text-gray-600 hover:text-blue-600 transition-colors">Kontak</a>
            </div>

            <div class="hidden md:flex items-center space-x-3">
                <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg px-5 py-2 hover:bg-gray-50 transition-all duration-200 hover:shadow-md">Masuk</a>
            </div>

            <button data-collapse-toggle="mobile-menu" type="button" class="md:hidden inline-flex items-center p-2 rounded-lg text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="mobile-menu" aria-expanded="false">
                <span class="sr-only">Buka menu</span>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
        </div>
    </div>
    <div class="hidden md:hidden border-t border-gray-100" id="mobile-menu">
        <div class="px-4 py-3 space-y-2">
            <a href="#hero" class="block px-3 py-2 text-sm font-medium text-blue-600 rounded-lg bg-blue-50">Beranda</a>
            <a href="#fitur" class="block px-3 py-2 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-50">Fitur</a>
            <a href="#tentang" class="block px-3 py-2 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-50">Tentang</a>
            <a href="#kontak" class="block px-3 py-2 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-50">Kontak</a>
            <hr class="my-2">
            <a href="{{ route('login') }}" class="block px-3 py-2 text-sm font-medium text-center text-white bg-blue-600 rounded-lg">Masuk</a>
        </div>
    </div>
</nav>

<!-- ==================== HERO ==================== -->
<section id="hero" class="relative pt-20 overflow-hidden bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500">
    <div class="absolute inset-0 opacity-10 pointer-events-none" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.4\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-28">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div class="text-center lg:text-left">
                <span class="inline-block px-4 py-1.5 bg-white/15 backdrop-blur-sm text-white text-xs font-semibold rounded-full mb-6">Platform Manajemen Rapor Digital</span>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white leading-tight">
                    Kelola Rapor Siswa
                    <span class="text-green-300">Lebih Mudah</span>
                </h1>
                <p class="mt-5 text-lg text-indigo-100 max-w-xl mx-auto lg:mx-0">
                    Sistem manajemen rapor sekolah terintegrasi dari input nilai hingga cetak rapor dalam satu platform digital yang cepat dan akurat.
                </p>
                <div class="mt-8 flex flex-col sm:flex-row items-center gap-4 justify-center lg:justify-start">
                    <a href="{{ route('login') }}" class="inline-flex items-center gap-2 bg-white text-indigo-700 font-bold px-8 py-3.5 rounded-lg hover:bg-gray-100 transition-all duration-200 hover:shadow-xl hover:-translate-y-0.5">
                        Mulai Sekarang
                        <span class="material-symbols-outlined text-lg">arrow_forward</span>
                    </a>
                    <a href="#fitur" class="inline-flex items-center gap-2 text-white border border-white/40 px-8 py-3.5 rounded-lg hover:bg-white/10 transition-all duration-200">
                        Lihat Fitur
                        <span class="material-symbols-outlined text-lg">expand_more</span>
                    </a>
                </div>

                <div class="mt-12 grid grid-cols-2 sm:grid-cols-4 gap-6">
                    <div class="text-center">
                        <div class="text-3xl font-extrabold text-white">1200+</div>
                        <div class="text-indigo-200 text-sm mt-1">Siswa</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-extrabold text-white">450+</div>
                        <div class="text-indigo-200 text-sm mt-1">Guru</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-extrabold text-white">14</div>
                        <div class="text-indigo-200 text-sm mt-1">Mata Pelajaran</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-extrabold text-white">10+</div>
                        <div class="text-indigo-200 text-sm mt-1">Sekolah</div>
                    </div>
                </div>
            </div>

            <div class="hidden lg:flex justify-center">
                <img src="{{ asset('images/homepage.png') }}" alt="SiRapor Illustration" class="w-full max-w-lg rounded-2xl shadow-2xl">
            </div>
        </div>
    </div>

    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 60V30C240 0 480 0 720 30C960 60 1200 60 1440 30V60H0Z" fill="white"/>
        </svg>
    </div>
</section>

<!-- ==================== FITUR ==================== -->
<section id="fitur" class="py-20 lg:py-28 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <span class="inline-block px-4 py-1.5 bg-indigo-100 text-indigo-700 text-xs font-semibold rounded-full mb-4">FITUR</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900">Semua Kebutuhan Akademik dalam Satu Platform</h2>
            <p class="mt-4 text-gray-500">Fitur lengkap yang memudahkan guru, wali kelas, dan admin dalam mengelola data akademik sekolah.</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
            <div class="group p-6 bg-white border border-gray-200 rounded-xl hover:shadow-xl hover:border-indigo-200 transition-all duration-300 hover:-translate-y-1">
                <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-indigo-200 transition-colors">
                    <svg class="w-6 h-6 text-indigo-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Manajemen Data Siswa</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Kelola data siswa dengan tambah, edit, dan cari data siswa secara cepat.</p>
            </div>

            <div class="group p-6 bg-white border border-gray-200 rounded-xl hover:shadow-xl hover:border-green-200 transition-all duration-300 hover:-translate-y-1">
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-green-200 transition-colors">
                    <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14l4-4h12c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2z"/></svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Input Nilai</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Input nilai tugas, ulangan harian, PTS, dan PAS dengan antarmuka yang intuitif.</p>
            </div>

            <div class="group p-6 bg-white border border-gray-200 rounded-xl hover:shadow-xl hover:border-orange-200 transition-all duration-300 hover:-translate-y-1">
                <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-orange-200 transition-colors">
                    <svg class="w-6 h-6 text-orange-600" fill="currentColor" viewBox="0 0 24 24"><path d="M3 13h2v-2H3v2zm0 4h2v-2H3v2zm0-8h2V7H3v2zm4 0h14V7H7v2zm0 4h14v-2H7v2zm0 4h14v-2H7v2z"/></svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Rekap Nilai Otomatis</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Perhitungan nilai akhir otomatis dan hemat waktu</p>
            </div>

            <div class="group p-6 bg-white border border-gray-200 rounded-xl hover:shadow-xl hover:border-purple-200 transition-all duration-300 hover:-translate-y-1">
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-purple-200 transition-colors">
                    <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 24 24"><path d="M19 8H5c-1.1 0-2-.9-2-2s.9-2 2-2h14c1.1 0 2 .9 2 2s-.9 2-2 2zm0 2H5c-1.1 0-2 .9-2 2s.9 2 2 2h14c1.1 0 2-.9 2-2s-.9-2-2-2zm0 4H5c-1.1 0-2 .9-2 2s.9 2 2 2h14c1.1 0 2-.9 2-2s-.9-2-2-2z"/></svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Cetak Rapor</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Generate rapor siap cetak</p>
            </div>

            <div class="group p-6 bg-white border border-gray-200 rounded-xl hover:shadow-xl hover:border-blue-200 transition-all duration-300 hover:-translate-y-1">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-blue-200 transition-colors">
                    <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 24 24"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Multi-Role Access</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Hak akses berbeda untuk Admin, Guru, dan Wali Kelas</p>
            </div>

            <div class="group p-6 bg-white border border-gray-200 rounded-xl hover:shadow-xl hover:border-rose-200 transition-all duration-300 hover:-translate-y-1">
                <div class="w-12 h-12 bg-rose-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-rose-200 transition-colors">
                    <svg class="w-6 h-6 text-rose-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 10.99h7c-.53 4.12-3.28 7.79-7 8.94V12H5V6.3l7-3.11v8.8z"/></svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Keamanan Data</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Sistem autentikasi berlapis dengan enkripsi password untuk keamanan data sekolah.</p>
            </div>
        </div>
    </div>
</section>

<!-- ==================== TENTANG ==================== -->
<section id="tentang" class="py-20 lg:py-28 bg-gradient-to-br from-gray-50 to-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <span class="inline-block px-4 py-1.5 bg-indigo-100 text-indigo-700 text-xs font-semibold rounded-full mb-4">TENTANG</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900">Kenapa SiRapor?</h2>
            <p class="mt-4 text-gray-500">Platform manajemen rapor sekolah digital yang dirancang untuk mempermudah proses pengelolaan nilai dan laporan akademik.</p>
        </div>

        <div class="grid md:grid-cols-2 gap-8 mb-16">
            <div class="bg-white rounded-2xl border border-gray-200 p-8 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <div class="w-14 h-14 bg-indigo-100 rounded-2xl flex items-center justify-center mb-5">
                    <svg class="w-7 h-7 text-indigo-600" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12 2c-.791 0-1.55.314-2.11.874l-.893.893a.985.985 0 0 1-.696.288H7.04A2.984 2.984 0 0 0 4.055 7.04v1.262a.986.986 0 0 1-.288.696l-.893.893a2.984 2.984 0 0 0 0 4.22l.893.893a.985.985 0 0 1 .288.696v1.262a2.984 2.984 0 0 0 2.984 2.984h1.262c.261 0 .512.104.696.288l.893.893a2.984 2.984 0 0 0 4.22 0l.893-.893a.985.985 0 0 1 .696-.288h1.262a2.984 2.984 0 0 0 2.984-2.984V15.7c0-.261.104-.512.288-.696l.893-.893a2.984 2.984 0 0 0 0-4.22l-.893-.893a.985.985 0 0 1-.288-.696V7.04a2.984 2.984 0 0 0-2.984-2.984h-1.262a.985.985 0 0 1-.696-.288l-.893-.893A2.984 2.984 0 0 0 12 2Zm3.683 7.73a1 1 0 1 0-1.414-1.413l-4.253 4.253-1.277-1.277a1 1 0 0 0-1.415 1.414l1.985 1.984a1 1 0 0 0 1.414 0l4.96-4.96Z" clip-rule="evenodd"/></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Visi</h3>
                <p class="text-gray-600 leading-relaxed">Menjadi solusi terdepan dalam digitalisasi sistem penilaian dan pelaporan akademik di lingkungan pendidikan Indonesia, sehingga proses evaluasi menjadi lebih transparan, efisien, dan mudah diakses.</p>
            </div>

            <div class="bg-white rounded-2xl border border-gray-200 p-8 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <div class="w-14 h-14 bg-emerald-100 rounded-2xl flex items-center justify-center mb-5">
                    <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m7.171 12.906-2.153 6.411 2.672-.89 1.568 2.34 1.825-5.183m5.73-2.678 2.154 6.411-2.673-.89-1.568 2.34-1.825-5.183M9.165 4.3c.58.068 1.153-.17 1.515-.628a1.681 1.681 0 0 1 2.64 0 1.68 1.68 0 0 0 1.515.628 1.681 1.681 0 0 1 1.866 1.866c-.068.58.17 1.154.628 1.516a1.681 1.681 0 0 1 0 2.639 1.682 1.682 0 0 0-.628 1.515 1.681 1.681 0 0 1-1.866 1.866 1.681 1.681 0 0 0-1.516.628 1.681 1.681 0 0 1-2.639 0 1.681 1.681 0 0 0-1.515-.628 1.681 1.681 0 0 1-1.867-1.866 1.681 1.681 0 0 0-.627-1.515 1.681 1.681 0 0 1 0-2.64c.458-.361.696-.935.627-1.515A1.681 1.681 0 0 1 9.165 4.3ZM14 9a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Misi</h3>
                <p class="text-gray-600 leading-relaxed">Membantu sekolah dan institusi pendidikan mengelola data siswa, nilai akademik secara terpusat. Mendukung guru dalam proses pengajaran dan memberikan kemudahan dalam memantau perkembangan siswa.</p>
            </div>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            <div class="text-center p-8 bg-white rounded-2xl border border-gray-200 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-5">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4.5V19a1 1 0 0 0 1 1h15M7 14l4-4 4 4 5-5m0 0h-3.207M20 9v3.207"/></svg>
                </div>
                <h4 class="text-lg font-bold text-gray-900 mb-2">Real-time</h4>
                <p class="text-gray-500 text-sm">Data nilai dan informasi diperbarui secara langsung dan akurat.</p>
            </div>

            <div class="text-center p-8 bg-white rounded-2xl border border-gray-200 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                <div class="w-16 h-16 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-5">
                    <svg class="w-8 h-8 text-amber-600" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M10 5a2 2 0 0 0-2 2v3h2.4A7.48 7.48 0 0 0 8 15.5a7.48 7.48 0 0 0 2.4 5.5H5a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h1V7a4 4 0 1 1 8 0v1.15a7.446 7.446 0 0 0-1.943.685A.999.999 0 0 1 12 8.5V7a2 2 0 0 0-2-2Z" clip-rule="evenodd"/><path fill-rule="evenodd" d="M10 15.5a5.5 5.5 0 1 1 11 0 5.5 5.5 0 0 1-11 0Zm6.5-1.5a1 1 0 1 0-2 0v1.5a1 1 0 0 0 .293.707l1 1a1 1 0 0 0 1.414-1.414l-.707-.707V14Z" clip-rule="evenodd"/></svg>
                </div>
                <h4 class="text-lg font-bold text-gray-900 mb-2">Aman</h4>
                <p class="text-gray-500 text-sm">Hak akses berbasis peran menjaga keamanan dan kerahasiaan data.</p>
            </div>

            <div class="text-center p-8 bg-white rounded-2xl border border-gray-200 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                <div class="w-16 h-16 bg-rose-100 rounded-full flex items-center justify-center mx-auto mb-5">
                    <svg class="w-8 h-8 text-rose-600" fill="currentColor" viewBox="0 0 24 24"><path d="M5 3a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2H5Zm14 18a2 2 0 0 0 2-2v-2a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h4ZM5 11a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2v-6a2 2 0 0 0-2-2H5Zm14 2a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h4Z"/></svg>
                </div>
                <h4 class="text-lg font-bold text-gray-900 mb-2">Efisien</h4>
                <p class="text-gray-500 text-sm">Perhitungan nilai otomatis menghemat waktu dan tenaga guru.</p>
            </div>
        </div>
    </div>
</section>

<!-- ==================== CTA ==================== -->
<section class="py-16 bg-gradient-to-r from-indigo-600 to-purple-700">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-3xl sm:text-4xl font-extrabold text-white mb-4">Siap Mempermudah Pengelolaan Rapor?</h2>
        <p class="text-indigo-200 mb-8 max-w-xl mx-auto">Mulai gunakan SiRapor sekarang dan rasakan kemudahan dalam mengelola nilai dan rapor siswa.</p>
        <a href="{{ route('login') }}" class="inline-flex items-center gap-2 bg-white text-indigo-700 font-bold px-8 py-3.5 rounded-lg hover:bg-gray-100 transition-all duration-200 hover:shadow-xl hover:-translate-y-0.5">
            Mulai Sekarang
            <span class="material-symbols-outlined text-lg">login</span>
        </a>
    </div>
</section>

<!-- ==================== FOOTER ==================== -->
<footer id="kontak" class="bg-gray-900 text-gray-400 py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-4 gap-8">
            <div class="md:col-span-2">
                <div class="flex items-center space-x-3 mb-4">
                    <img src="{{ asset('images/open-book.png') }}" class="h-8 w-auto brightness-0 invert" alt="SiRapor">
                    <span class="text-lg font-bold text-white">SiRapor</span>
                </div>
                <p class="text-sm max-w-sm leading-relaxed">Platform manajemen rapor sekolah digital yang memudahkan pengelolaan nilai dan laporan akademik secara terpusat.</p>
            </div>
            <div>
                <h5 class="text-white font-semibold mb-4">Menu</h5>
                <ul class="space-y-2 text-sm">
                    <li><a href="#hero" class="hover:text-white transition-colors">Beranda</a></li>
                    <li><a href="#fitur" class="hover:text-white transition-colors">Fitur</a></li>
                    <li><a href="#tentang" class="hover:text-white transition-colors">Tentang</a></li>
                </ul>
            </div>
            <div>
                <h5 class="text-white font-semibold mb-4">Kontak</h5>
                <ul class="space-y-2 text-sm">
                    <li class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-base">mail</span>
                        info@sirapoor.id
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-base">location_on</span>
                        Indonesia
                    </li>
                </ul>
            </div>
        </div>
        <div class="border-t border-gray-800 mt-10 pt-8 text-center text-sm">
            &copy; {{ date('Y') }} SiRapor. All rights reserved.
        </div>
    </div>
</footer>

</body>
</html>
