DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lapor Siswa - Digital Academic Portal</title>
      @vite(['resources/css/app.css', 'resources/js/app.js'])
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;family=Inter:wght@400;500;600&amp;family=JetBrains+Mono:wght@500&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "surface-container-high": "#e6e8ea",
                        "tertiary-fixed": "#ffddb8",
                        "secondary-container": "#6cf8bb",
                        "surface-dim": "#d8dadc",
                        "inverse-surface": "#2d3133",
                        "secondary": "#006c49",
                        "error-container": "#ffdad6",
                        "on-secondary-container": "#00714d",
                        "surface-container-low": "#f2f4f6",
                        "on-tertiary-fixed": "#2a1700",
                        "inverse-primary": "#b4c5ff",
                        "on-surface": "#191c1e",
                        "surface-bright": "#f7f9fb",
                        "tertiary-container": "#996100",
                        "on-tertiary-container": "#ffeedd",
                        "surface-container-highest": "#e0e3e5",
                        "on-secondary": "#ffffff",
                        "tertiary-fixed-dim": "#ffb95f",
                        "on-tertiary": "#ffffff",
                        "surface": "#f7f9fb",
                        "on-tertiary-fixed-variant": "#653e00",
                        "on-error": "#ffffff",
                        "surface-tint": "#0053db",
                        "background": "#f7f9fb",
                        "primary-fixed-dim": "#b4c5ff",
                        "on-primary": "#ffffff",
                        "surface-container-lowest": "#ffffff",
                        "on-primary-fixed-variant": "#003ea8",
                        "on-surface-variant": "#434655",
                        "on-primary-fixed": "#00174b",
                        "secondary-fixed-dim": "#4edea3",
                        "on-secondary-fixed-variant": "#005236",
                        "surface-container": "#eceef0",
                        "on-error-container": "#93000a",
                        "primary": "#004ac6",
                        "outline": "#737686",
                        "surface-variant": "#e0e3e5",
                        "outline-variant": "#c3c6d7",
                        "on-secondary-fixed": "#002113",
                        "tertiary": "#784b00",
                        "primary-fixed": "#dbe1ff",
                        "on-background": "#191c1e",
                        "on-primary-container": "#eeefff",
                        "error": "#ba1a1a",
                        "secondary-fixed": "#6ffbbe",
                        "inverse-on-surface": "#eff1f3",
                        "primary-container": "#2563eb"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "2xl": "1rem",
                        "full": "9999px"
                    },
                    "fontFamily": {
                        "headline": ["Plus Jakarta Sans"],
                        "body": ["Inter"],
                        "label": ["Inter"],
                        "mono": ["JetBrains Mono"]
                    }
                },
            },
        }
    </script>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .glass-nav {
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        .glow-shadow {
            box-shadow: 0 8px 30px rgba(37, 99, 235, 0.15);
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f7f9fb;
        }
        h1, h2, h3, h4 {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body class="text-on-surface bg-background">

<!-- Desktop Nav -->
<div class="hidden md:flex items-center gap-8 font-headline text-sm font-medium">
<a class="text-primary font-semibold border-b-2 border-primary" href="#">Beranda</a>
<a class="text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-slate-200 transition-all duration-300" href="#">Fitur</a>
<a class="text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-slate-200 transition-all duration-300" href="#">Tentang</a>
<a class="text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-slate-200 transition-all duration-300" href="#">Panduan</a>
</div>
<div class="flex items-center gap-3">
<button class="p-2 text-slate-600 dark:text-slate-400 hover:bg-slate-100/50 dark:hover:bg-slate-800/50 rounded-full transition-all duration-300">
<span class="material-symbols-outlined">dark_mode</span>
</button>
<button class="px-4 py-2 text-sm font-semibold text-slate-600 dark:text-slate-400 hover:text-primary transition-colors">Masuk</button>
<button class="px-5 py-2 text-sm font-bold text-white bg-gradient-to-br from-primary to-primary-container rounded-xl shadow-lg hover:scale-95 active:scale-90 transition-transform">Daftar</button>
</div>
</nav>
<!-- Hero Section -->
<section class="relative pt-32 pb-20 overflow-hidden">
<!-- Subtle Grid Pattern -->
<div class="absolute inset-0 z-0 opacity-10 pointer-events-none" style="background-image: radial-gradient(#004ac6 1px, transparent 1px); background-size: 40px 40px;"></div>
<div class="max-w-7xl mx-auto px-8 relative z-10 flex flex-col md:flex-row items-center gap-16">
<!-- Hero Left -->
<div class="flex-1 space-y-8">
<span class="inline-flex items-center px-4 py-1.5 rounded-full bg-primary-fixed text-on-primary-fixed text-sm font-bold tracking-wide">
<span class="material-symbols-outlined text-[18px] mr-2" style="font-variation-settings: 'FILL' 1;">verified_user</span>
                    🏫 PLATFORM RAPOR DIGITAL
                </span>
<h1 class="text-5xl md:text-6xl font-extrabold text-on-surface leading-tight tracking-tight">
                    Kelola Rapor Siswa <br/>
<span class="text-primary italic">Lebih Mudah, Cepat, dan Akurat</span>
</h1>
<p class="text-lg text-on-surface-variant leading-relaxed max-w-xl">
                    Sistem manajemen rapor sekolah yang terintegrasi — dari input nilai hingga cetak rapor, semua dalam satu platform.
                </p>
<div class="flex flex-wrap gap-4 pt-4">
<button class="px-8 py-4 bg-gradient-to-r from-primary to-primary-container text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex items-center gap-2">
                        Mulai Sekarang
                        <span class="material-symbols-outlined">arrow_forward</span>
</button>
<button class="px-8 py-4 bg-surface-container-high text-on-surface font-bold rounded-xl hover:bg-surface-container-highest transition-all duration-300">
                        Lihat Demo
                    </button>
</div>
<div class="pt-8 flex items-center gap-8 text-on-surface-variant font-mono text-sm border-t border-outline-variant/20">
<div class="flex flex-col">
<span class="text-2xl font-bold text-on-surface">1.200+</span>
<span>Siswa Terdaftar</span>
</div>
<div class="flex flex-col">
<span class="text-2xl font-bold text-on-surface">450+</span>
<span>Guru Aktif</span>
</div>
<div class="flex flex-col">
<span class="text-2xl font-bold text-on-surface">98%</span>
<span>Kehadiran Data</span>
</div>
</div>
</div>
<!-- Hero Right: Floating Dashboard UI -->
<div class="flex-1 relative">
<div class="relative z-20 bg-surface-container-lowest p-6 rounded-[2rem] shadow-[0_30px_60px_-15px_rgba(0,0,0,0.1)] glow-shadow border border-white/40">
<div class="flex justify-between items-center mb-6">
<div class="flex items-center gap-3">
<img class="w-10 h-10 rounded-full bg-slate-200" data-alt="close-up portrait of a student avatar in minimalist illustration style with soft pastel colors" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCL04A7yTZzE1bU45qqfLC0C39fcOIoWNF62KxSLRUSFdV0f0JHLIyU2dfvr4IYdpKD3RI9Tu-F_7bTzjj8yeqKnZGJ2V0uBn9w0g5xqoP2LDxcAJ0MffeZ-4nthyB0sYI2GlmZcNYwWYiweIlksFsffYoZlkxa-puIlgfkXD6ldBVthNt_KXiboUuNjhJp8CRBTqlyE6DvjnuApVus5sF7y0Hx1lY6tIJwVjNIZWt4nKDx0JR_9YxMwqxeOKSdZ2ppeVCEUY5PhBc"/>
<div>
<h4 class="text-sm font-bold text-on-surface">Ariana Grande</h4>
<p class="text-[10px] text-on-surface-variant font-mono">ID: 2024-0012</p>
</div>
</div>
<span class="px-3 py-1 bg-secondary-container text-on-secondary-container rounded-full text-[10px] font-bold">ACTIVE</span>
</div>
<div class="grid grid-cols-2 gap-4 mb-6">
<div class="p-4 bg-surface-container-low rounded-2xl">
<p class="text-[10px] text-on-surface-variant uppercase tracking-widest mb-1">Rata-rata</p>
<div class="flex items-baseline gap-1">
<span class="text-2xl font-bold font-mono text-primary">88.5</span>
<span class="text-[10px] text-on-surface-variant">/100</span>
</div>
</div>
<div class="p-4 bg-surface-container-low rounded-2xl flex items-center justify-center">
<div class="relative w-12 h-12 flex items-center justify-center">
<svg class="w-full h-full -rotate-90">
<circle cx="24" cy="24" fill="transparent" r="20" stroke="#e6e8ea" stroke-width="4"></circle>
<circle cx="24" cy="24" fill="transparent" r="20" stroke="#004ac6" stroke-dasharray="125.6" stroke-dashoffset="25.12" stroke-width="4"></circle>
</svg>
<span class="absolute text-[10px] font-bold font-mono">A</span>
</div>
</div>
</div>
<div class="space-y-3">
<div class="flex justify-between items-center p-3 bg-surface-container-lowest rounded-xl border-l-4 border-primary shadow-sm">
<span class="text-xs font-semibold">Matematika</span>
<span class="font-mono text-xs font-bold">92</span>
</div>
<div class="flex justify-between items-center p-3 bg-surface-container-lowest rounded-xl border-l-4 border-secondary shadow-sm">
<span class="text-xs font-semibold">Bahasa Inggris</span>
<span class="font-mono text-xs font-bold">85</span>
</div>
<div class="flex justify-between items-center p-3 bg-surface-container-lowest rounded-xl border-l-4 border-tertiary shadow-sm">
<span class="text-xs font-semibold">Fisika Terapan</span>
<span class="font-mono text-xs font-bold">89</span>
</div>
</div>
</div>
<!-- Floating Accents -->
<div class="absolute -top-10 -right-6 w-32 h-32 bg-secondary/10 rounded-full blur-3xl"></div>
<div class="absolute -bottom-10 -left-6 w-40 h-40 bg-primary/10 rounded-full blur-3xl"></div>
</div>
</div>
</section>
<!-- Features Section -->
<section class="py-24 bg-surface-container-low">
<div class="max-w-7xl mx-auto px-8">
<div class="text-center mb-16">
<h2 class="text-4xl font-extrabold text-on-surface mb-4">Semua yang Kamu Butuhkan</h2>
<p class="text-on-surface-variant max-w-2xl mx-auto">Dirancang untuk efisiensi maksimal dalam manajemen akademik sekolah modern.</p>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
<!-- Feature 1 -->
<div class="group bg-surface-container-lowest p-8 rounded-3xl transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl">
<div class="w-14 h-14 bg-primary-fixed rounded-2xl flex items-center justify-center text-primary mb-6 group-hover:scale-110 transition-transform">
<span class="material-symbols-outlined text-3xl">edit_document</span>
</div>
<h3 class="text-xl font-bold mb-3">Input Nilai Digital</h3>
<p class="text-on-surface-variant text-sm leading-relaxed">Proses input nilai yang intuitif dan cepat dengan validasi otomatis untuk mencegah kesalahan data.</p>
</div>
<!-- Feature 2 -->
<div class="group bg-surface-container-lowest p-8 rounded-3xl transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl">
<div class="w-14 h-14 bg-secondary-fixed rounded-2xl flex items-center justify-center text-secondary mb-6 group-hover:scale-110 transition-transform">
<span class="material-symbols-outlined text-3xl">analytics</span>
</div>
<h3 class="text-xl font-bold mb-3">Rekap Otomatis</h3>
<p class="text-on-surface-variant text-sm leading-relaxed">Penghitungan nilai rata-rata, peringkat, dan statistik kelas secara real-time tanpa rumus manual.</p>
</div>
<!-- Feature 3 -->
<div class="group bg-surface-container-lowest p-8 rounded-3xl transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl">
<div class="w-14 h-14 bg-tertiary-fixed rounded-2xl flex items-center justify-center text-tertiary mb-6 group-hover:scale-110 transition-transform">
<span class="material-symbols-outlined text-3xl">picture_as_pdf</span>
</div>
<h3 class="text-xl font-bold mb-3">Cetak Rapor PDF</h3>
<p class="text-on-surface-variant text-sm leading-relaxed">Ekspor rapor ke format PDF yang rapi, profesional, dan siap cetak hanya dengan satu klik.</p>
</div>
<!-- Feature 4 -->
<div class="group bg-surface-container-lowest p-8 rounded-3xl transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl">
<div class="w-14 h-14 bg-primary-fixed rounded-2xl flex items-center justify-center text-primary mb-6 group-hover:scale-110 transition-transform">
<span class="material-symbols-outlined text-3xl">group</span>
</div>
<h3 class="text-xl font-bold mb-3">Multi-Role Akses</h3>
<p class="text-on-surface-variant text-sm leading-relaxed">Akses terpisah untuk Admin, Guru, dan Siswa dengan tingkat keamanan dan izin yang berbeda.</p>
</div>
<!-- Feature 5 -->
<div class="group bg-surface-container-lowest p-8 rounded-3xl transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl">
<div class="w-14 h-14 bg-secondary-fixed rounded-2xl flex items-center justify-center text-secondary mb-6 group-hover:scale-110 transition-transform">
<span class="material-symbols-outlined text-3xl">calendar_month</span>
</div>
<h3 class="text-xl font-bold mb-3">Manajemen Semester</h3>
<p class="text-on-surface-variant text-sm leading-relaxed">Kelola data per tahun ajaran dan semester dengan mudah tanpa menimpa data lama.</p>
</div>
<!-- Feature 6 -->
<div class="group bg-surface-container-lowest p-8 rounded-3xl transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl">
<div class="w-14 h-14 bg-error-container rounded-2xl flex items-center justify-center text-error mb-6 group-hover:scale-110 transition-transform">
<span class="material-symbols-outlined text-3xl">lock</span>
</div>
<h3 class="text-xl font-bold mb-3">Data Aman &amp; Terenkripsi</h3>
<p class="text-on-surface-variant text-sm leading-relaxed">Keamanan data prioritas utama kami. Semua informasi dienkripsi dengan standar industri.</p>
</div>
</div>
</div>
</section>
<!-- How It Works Section -->
<section class="py-24 overflow-hidden">
<div class="max-w-7xl mx-auto px-8">
<div class="text-center mb-20">
<h2 class="text-4xl font-extrabold text-on-surface mb-4">Bagaimana Cara Kerjanya?</h2>
<p class="text-on-surface-variant">Hanya butuh 5 langkah mudah untuk mendigitalkan rapor sekolah Anda.</p>
</div>
<div class="relative">
<!-- Line background -->
<div class="absolute top-1/2 left-0 w-full h-1 bg-surface-container hidden md:block -translate-y-1/2"></div>
<div class="grid grid-cols-1 md:grid-cols-5 gap-8 relative z-10">
<!-- Step 1 -->
<div class="flex flex-col items-center text-center group">
<div class="w-16 h-16 rounded-full bg-white text-primary flex items-center justify-center font-bold text-xl shadow-lg border-4 border-primary-fixed mb-6 transition-transform group-hover:scale-110">1</div>
<h4 class="font-bold mb-2">Daftar &amp; Login</h4>
<p class="text-xs text-on-surface-variant px-4">Buat akun sekolah dan masuk ke dashboard.</p>
</div>
<!-- Step 2 -->
<div class="flex flex-col items-center text-center group">
<div class="w-16 h-16 rounded-full bg-white text-primary flex items-center justify-center font-bold text-xl shadow-lg border-4 border-primary-fixed mb-6 transition-transform group-hover:scale-110">2</div>
<h4 class="font-bold mb-2">Input Data Siswa</h4>
<p class="text-xs text-on-surface-variant px-4">Lengkapi profil siswa dan data kelas.</p>
</div>
<!-- Step 3 -->
<div class="flex flex-col items-center text-center group">
<div class="w-16 h-16 rounded-full bg-white text-primary flex items-center justify-center font-bold text-xl shadow-lg border-4 border-primary-fixed mb-6 transition-transform group-hover:scale-110">3</div>
<h4 class="font-bold mb-2">Masukkan Nilai</h4>
<p class="text-xs text-on-surface-variant px-4">Guru menginput nilai setiap mata pelajaran.</p>
</div>
<!-- Step 4 -->
<div class="flex flex-col items-center text-center group">
<div class="w-16 h-16 rounded-full bg-white text-primary flex items-center justify-center font-bold text-xl shadow-lg border-4 border-primary-fixed mb-6 transition-transform group-hover:scale-110">4</div>
<h4 class="font-bold mb-2">Generate Rapor</h4>
<p class="text-xs text-on-surface-variant px-4">Sistem menghitung rekapitulasi secara otomatis.</p>
</div>
<!-- Step 5 -->
<div class="flex flex-col items-center text-center group">
<div class="w-16 h-16 rounded-full bg-white text-primary flex items-center justify-center font-bold text-xl shadow-lg border-4 border-primary-fixed mb-6 transition-transform group-hover:scale-110">5</div>
<h4 class="font-bold mb-2">Cetak &amp; Bagi</h4>
<p class="text-xs text-on-surface-variant px-4">Rapor siap dibagikan dalam format PDF.</p>
</div>
</div>
</div>
</div>
</section>
<!-- Role Preview Section -->
<section class="py-24 bg-surface-container-low">
<div class="max-w-7xl mx-auto px-8">
<div class="grid grid-cols-1 md:grid-cols-3 gap-12">
<!-- Admin Card -->
<div class="bg-white rounded-[2rem] p-8 shadow-sm border-t-8 border-primary">
<span class="material-symbols-outlined text-4xl text-primary mb-6">admin_panel_settings</span>
<h3 class="text-2xl font-bold mb-4">Untuk Admin</h3>
<p class="text-on-surface-variant mb-6 leading-relaxed">Kendali penuh atas infrastruktur sekolah, manajemen guru, mata pelajaran, dan konfigurasi tahun ajaran secara global.</p>
<ul class="space-y-3 text-sm font-medium">
<li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-sm">check_circle</span> Manajemen Master Data</li>
<li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-sm">check_circle</span> Kontrol Hak Akses</li>
<li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-sm">check_circle</span> Audit Log Aktivitas</li>
</ul>
</div>
<!-- Guru Card -->
<div class="bg-white rounded-[2rem] p-8 shadow-sm border-t-8 border-secondary">
<span class="material-symbols-outlined text-4xl text-secondary mb-6">draw</span>
<h3 class="text-2xl font-bold mb-4">Untuk Guru</h3>
<p class="text-on-surface-variant mb-6 leading-relaxed">Efisiensi penginputan nilai harian, UTS, hingga UAS. Analisis performa siswa di kelas secara langsung dan akurat.</p>
<ul class="space-y-3 text-sm font-medium">
<li class="flex items-center gap-2"><span class="material-symbols-outlined text-secondary text-sm">check_circle</span> Input Nilai Kolektif</li>
<li class="flex items-center gap-2"><span class="material-symbols-outlined text-secondary text-sm">check_circle</span> Rekap Presensi</li>
<li class="flex items-center gap-2"><span class="material-symbols-outlined text-secondary text-sm">check_circle</span> Export Nilai Excel</li>
</ul>
</div>
<!-- Siswa Card -->
<div class="bg-white rounded-[2rem] p-8 shadow-sm border-t-8 border-tertiary">
<span class="material-symbols-outlined text-4xl text-tertiary mb-6">person_search</span>
<h3 class="text-2xl font-bold mb-4">Untuk Siswa</h3>
<p class="text-on-surface-variant mb-6 leading-relaxed">Pantau perkembangan nilai secara transparan. Download rapor kapanpun dibutuhkan tanpa harus ke sekolah.</p>
<ul class="space-y-3 text-sm font-medium">
<li class="flex items-center gap-2"><span class="material-symbols-outlined text-tertiary text-sm">check_circle</span> Lihat Grafik Progres</li>
<li class="flex items-center gap-2"><span class="material-symbols-outlined text-tertiary text-sm">check_circle</span> Download PDF Rapor</li>
<li class="flex items-center gap-2"><span class="material-symbols-outlined text-tertiary text-sm">check_circle</span> Pengumuman Sekolah</li>
</ul>
</div>
</div>
</div>
</section>
<!-- CTA Banner -->
<section class="max-w-7xl mx-auto px-8 mb-24">
<div class="relative overflow-hidden bg-gradient-to-br from-primary to-primary-container rounded-[3rem] p-12 md:p-20 text-center text-white shadow-2xl">
<div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/2 blur-3xl"></div>
<div class="absolute bottom-0 left-0 w-48 h-48 bg-black/10 rounded-full translate-y-1/2 -translate-x-1/2 blur-3xl"></div>
<h2 class="text-4xl md:text-5xl font-extrabold mb-6 relative z-10">Siap Digitalisasi Rapor Sekolahmu?</h2>
<p class="text-primary-fixed max-w-xl mx-auto mb-10 text-lg relative z-10">Daftarkan sekolah Anda sekarang dan rasakan kemudahan pengelolaan administrasi akademik yang modern dan efisien.</p>
<div class="flex flex-col sm:flex-row justify-center gap-4 relative z-10">
<button class="px-10 py-5 bg-white text-primary font-extrabold rounded-2xl shadow-xl hover:scale-105 active:scale-95 transition-all">Mulai Gratis Sekarang</button>
<button class="px-10 py-5 bg-primary-container/20 backdrop-blur-md text-white border-2 border-white/30 font-extrabold rounded-2xl hover:bg-primary-container/40 transition-all">Hubungi Tim Sales</button>
</div>
</div>
</section>
<!-- Footer -->
<footer class="bg-slate-50 dark:bg-slate-950 border-t border-slate-200/50 dark:border-slate-800/50 pt-20">
<div class="grid grid-cols-1 md:grid-cols-4 gap-12 px-8 pb-16 max-w-7xl mx-auto font-['Plus_Jakarta_Sans'] text-sm leading-relaxed">
<div class="space-y-6">
<div class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
<span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">school</span>
                    Lapor Siswa
                </div>
<p class="text-slate-500 max-w-xs">Solusi manajemen akademik sekolah terdepan di Indonesia. Membawa transparansi dan efisiensi ke setiap ruang kelas.</p>
</div>
<div class="space-y-4">
<h4 class="font-bold text-slate-900 dark:text-white uppercase tracking-widest text-xs">Navigasi</h4>
<ul class="space-y-3 text-slate-500">
<li><a class="hover:text-primary transition-all" href="#">Beranda</a></li>
<li><a class="hover:text-primary transition-all" href="#">Fitur Utama</a></li>
<li><a class="hover:text-primary transition-all" href="#">Harga Layanan</a></li>
<li><a class="hover:text-primary transition-all" href="#">Tentang Kami</a></li>
</ul>
</div>
<div class="space-y-4">
<h4 class="font-bold text-slate-900 dark:text-white uppercase tracking-widest text-xs">Bantuan</h4>
<ul class="space-y-3 text-slate-500">
<li><a class="hover:text-primary transition-all" href="#">Panduan Pengguna</a></li>
<li><a class="hover:text-primary transition-all" href="#">Pusat Bantuan</a></li>
<li><a class="hover:text-primary transition-all" href="#">Kebijakan Privasi</a></li>
<li><a class="hover:text-primary transition-all" href="#">Syarat &amp; Ketentuan</a></li>
</ul>
</div>
<div class="space-y-4">
<h4 class="font-bold text-slate-900 dark:text-white uppercase tracking-widest text-xs">Kontak</h4>
<ul class="space-y-3 text-slate-500">
<li class="flex items-center gap-2"><span class="material-symbols-outlined text-[18px]">mail</span> info@laporsiswa.id</li>
<li class="flex items-center gap-2"><span class="material-symbols-outlined text-[18px]">call</span> +62 21 5550 1234</li>
<li class="flex items-center gap-2"><span class="material-symbols-outlined text-[18px]">location_on</span> Jakarta, Indonesia</li>
</ul>
</div>
</div>
<div class="border-t border-slate-200/50 dark:border-slate-800/50 py-8 px-8">
<div class="max-w-7xl mx-auto flex flex-col md:row justify-between items-center gap-4 text-slate-400 text-[10px] md:text-xs">
<p>© 2024 Lapor Siswa. The Academic Atelier Experience.</p>
<div class="flex items-center gap-6">
<span class="hover:text-slate-600 cursor-pointer">Twitter</span>
<span class="hover:text-slate-600 cursor-pointer">Instagram</span>
<span class="hover:text-slate-600 cursor-pointer">LinkedIn</span>
<div class="w-px h-4 bg-slate-200"></div>
<button class="p-1 rounded bg-slate-100 hover:bg-slate-200 transition-colors">
<span class="material-symbols-outlined text-[16px]">light_mode</span>
</button>
</div>
</div>
</div>
</footer>
</body></html>